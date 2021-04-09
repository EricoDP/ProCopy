function deleteTransaccion(url){
  if (confirm('Seguro que quieres borrar el registro?')) {
    location.href = url;
  }
}