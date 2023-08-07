// window.$ = window.jQuery = require('jquery')

// function handleFile(file) {
//   if (
//     file.type == 'image/jpeg' ||
//     file.type == 'image/png' ||
//     file.type == 'image/jpg'
//   ) {
//     let reader = new FileReader()
//     reader.onload = function (event) {
//       $('#fileInfoBox').addClass('show')
//       $('#fileInfoBox').removeClass('hide')
//       $('#previewImg').attr('src', event.target.result)
//     }
//     reader.readAsDataURL(file)
//   } else {
//     $('#message').html('Please Upload Images Only')
//   }
// }

// window.addEventListener('load', function () {
//   myFileList.addEventListener('drop', dropHandler, false)
//   myFileList.addEventListener(
//     'dragover',
//     function (ev) {
//       ev.preventDefault()
//     },
//     false,
//   )
//   function dropHandler(ev) {
//     ev.preventDefault()
//     var filelist = ev.dataTransfer.files
//     for (var i = 0, f; (f = filelist[i]); i++) {
//       var reader = new FileReader()
//       reader.onload = (function (theFile) {
//         handleFile(theFile)
//         document.querySelector('#fileup').files = theFile;
//       })(f)
//       break
//     }
//   }
// })

// $(document).ready(function () {
//   var readURL = function (input) {
//     console.log(readURL);
//     if (input.files && input.files[0]) {
//       handleFile(input.files[0])
//     }
//   }
//   $('.file-upload').on('change', function () {
//     readURL(this)
//   })
//   $('.upload-button').on('click', function () {
//     $('.file-upload').click()
//   })
// })
