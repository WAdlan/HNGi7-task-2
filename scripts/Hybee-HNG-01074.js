const data = {
  message: 'Hello world',
  name: 'Ibrahim Adekunle',
  id: 'HNG-01074',
  language: 'JavaScript',
  email: 'adefemi101@gmail.com',
};

const { message, name, id, language, email } = data;
const output = `${message}, this is ${name} with HNG ID ${id} and email ${email} using ${language} for stage 2 task.`;

return console.log(output);
