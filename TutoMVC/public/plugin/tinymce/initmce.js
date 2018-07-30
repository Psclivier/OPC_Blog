tinymce.init({
    selector: "#editeur",

    plugins: [
        "advlist autolink  lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media",
        "save table contextmenu directionality emoticons template paste textcolor"

    ],
    toolbar: 'undo redo | fontsizeselect fontselect | alignleft aligncenter alignright alignjustify | link image | bullist numlist outdent indent | forecolor backcolor emoticons',
    content_css: ['//fonts.googleapis.com/css?family=Indie+Flower'],
    font_formats: 'Arial Black=arial black,avant garde;Indie Flower=indie flower, cursive;Times New Roman=times new roman,times;'
});