function play(id, preview) {
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');    
    $('audio').attr('src', preview)
    document.getElementById('player').play()
    fetch('/historique/'+ id,  {
        method: 'post',
        credentials: 'same-origin',
        headers: {
          'X-CSRF-Token': token
        },
        body: 'test'
      }).then(rep => console.log(rep))
      .catch(error => console.log(error));    
}