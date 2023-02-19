    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
      Dropzone.options.myAwesomeDropzone = {
          url: "upload.php",
          paramName: "file",
          maxFilesize: 2, // MB
          maxFiles: 1,
          acceptedFiles: "image/*",
          previewsContainer: ".dropzone-previews",
          init: function() {
              this.on("success", function(file, response) {
                  console.log(response);
              });
          }
      };

    </script>
  </body>
</html>