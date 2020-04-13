function like(id, genre) {
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); 
    console.log('/like/' + genre + '/' +id)
    fetch('/like/' + genre + '/' +id,  {
        method: 'post',
        credentials: 'same-origin',
        headers: {
          'X-CSRF-Token': token
        },
        body: 'test',
      }).then(rep => console.log(rep))
      .catch(error => console.log(error));    
}