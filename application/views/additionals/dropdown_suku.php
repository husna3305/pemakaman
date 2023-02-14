<script>
  $(function() {
    $("#id_suku").select2({
      // minimumInputLength: 2,
      theme: 'bootstrap4',
      ajax: {
        url: "<?= site_url('api/private/suku/selectSuku') ?>",
        type: "POST",
        dataType: 'json',
        delay: 100,
        data: function(params) {
          return {
            searchTerm: params.term, // search term
          };
        },
        processResults: function(response) {
          return {
            results: $.map(response, function(item) {
              return {
                text: item.text,
                id: item.id
              }
            })
          };
        },
        cache: true
      }
    });
  });
</script>