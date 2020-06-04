let introduction = [{
  greet: 'Hello World',
  name: 'Ismail Jamiu Babatunde',
  id: 'HNG-04591',
  email: 'phantmoney2011@gmail.com',
  language: 'Javascript'
}]; 

const greetings = (info) => {

const myInfo = info.map(items =>{
  return ` ${items.greet}, this is ${items.name}  with HNGi7 ID ${items.id}, and email address ${items.email} using ${items.language} for stage 2 task `;
});

return myInfo;  
}

console.log(greetings(introduction));    

