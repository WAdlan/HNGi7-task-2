<?php

// Listen to URL query param if JSON output is enabled
$query = $_SERVER["QUERY_STRING"] ?? '';
$jsonEnabled = isset($query) && $query == 'json';
echo $jsonEnabled ? "JSON output is enabled \n\n" : "JSON output is disabled \n\n";

// Define a function to output files in a directory
function outputFiles($path)
{
  // totalOutput contains 2 arrays - valid (for valid file types), invalid (for unsupported file types)
  $totalOutput = ["valid" => [], "invalid" => []];

  // Check directory exists or not
  if (file_exists($path) && is_dir($path)) {
    // Scan the files in this directory
    $result = scandir($path);
    // Filter out the current (.) and parent (..) directories
    $files = array_diff($result, array('.', '..'));
    if (count($files) > 0) {
      // Loop through return array
      foreach ($files as $file) {
        $filePath = "$path/$file";
        if (is_file($filePath)) {
          // Split the filename
          $fileExtension = get_extension($file);
          if ($fileExtension) {
            switch ($fileExtension) {
              case 'js':
                $scriptOut = run_script("node $filePath 2>&1");
                array_push($totalOutput['valid'], $scriptOut);
                break;

              case 'py':
                $scriptOut = run_script("python $filePath 2>&1");
                array_push($totalOutput['valid'], $scriptOut);
                break;

              case 'php':
                $scriptOut = run_script("php $filePath 2>&1");
                array_push($totalOutput['valid'], $scriptOut);
                break;

              default:
                echo "'$file' is not valid \n";
                array_push($totalOutput['invalid'], $file);
                break;
            }
          }
        }
      }
    }
  }
  return $totalOutput; // return every single iteration
}
// get file extension
function get_extension($file)
{
  $tmp = explode(".", $file);
  $extension = end($tmp);
  return $extension ? $extension : false;
}

/**
 * Executes team member's scripts and returns an object with the required details
 * */
function run_script($command)
{

  $scriptOutput = [];
  $bashOut = exec($command);

  $status = getScriptOutputStatus($bashOut);

  $scriptOutput['output'] = $bashOut;
  $scriptOutput['status'] = $status;

  return $scriptOutput;
}

function getScriptOutputStatus($output)
{
  return preg_match('/^Hello\sWorld[,|.|!]?\sthis\sis\s[a-zA-Z]{2,}\s[a-zA-Z]{2,}(\s[a-zA-Z]{2,})?\swith\sHNGi7\sID\s(HNG-\d{3,})\sand\semail\s(([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6})\susing\s[a-zA-Z|#]{2,}\sfor\sstage\s2\stask.?$/i', trim($output)) ? 'passed' : 'failed';
}

// Call the function
$outs = outputFiles("scripts");

// preview the results
echo json_encode($outs);
