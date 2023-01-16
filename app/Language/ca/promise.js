CONSTRUIR:
let done = true
const isItDoneYet = new Promise((resolve, reject) => {
  if (done) {
    const workDone = 'Here is the thing I built'
    resolve(workDone)
  } else {
    const why = 'Still working on something else'
    reject(why)
  }
})

CONSUMIR:
const isItDoneYet = new Promise(/* ... as above ... */)
const checkIfItsDone = () => {
  isItDoneYet
    .then(ok => {
      console.log(ok)
    })
    .catch(err => {
      console.error(err)
    })
}

ENCADENAR:
new Promise(function(resolve, reject) {
  setTimeout(() => resolve('promises'),3000);
}). then(function(result) {
  console.log(result);
  return `${result} are`;
}).then(function(result) {
  console.log(result);
  return `${result} awesome`;
}).then(function(result){
  console.log(result);
  return `${result}.`;
})