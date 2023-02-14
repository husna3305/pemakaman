function toasts(tipe, title='', subtitle='', body='') {
  $(document).Toasts('create', {
    class: 'bg-'+tipe,
    title: title,
    subtitle: subtitle,
    body: body,
    autohide:true,
    delay:3300
  })
}