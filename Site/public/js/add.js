function add(idP, idM) {
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); 
    fetch('/add/playlist/' + idP + '/' + idM,  {
        method: 'post',
        credentials: 'same-origin',
        headers: {
          'X-CSRF-Token': token
        },
      }).then(rep => console.log(rep))
      .catch(error => console.log(error));    
}