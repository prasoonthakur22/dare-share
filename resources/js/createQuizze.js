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
//         document.querySelector('#fileup').files = theFile
//       })(f)
//       break
//     }
//   }
// })

// $(document).ready(function () {
//   var readURL = function (input) {
//     console.log(readURL)
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

// $(document).ready(function () {
//   $('#quizeeForm').on('submit', function (e) {
//     e.preventDefault()
//     if (true) {
//       let question = $('#question').val()
//       let dare_id = $('#dare_id').val()
//       if (!question) {
//         $('#message').html('Please enter question')
//         $('#message').addClass('block')
//         $('#message').removeClass('hidden')
//         setTimeout(function () {
//           $('#message').addClass('hidden')
//           $('#message').removeClass('block')
//         }, 3000)
//         return null
//       } else {
//         $('#choicesForm').addClass('hidden')
//         $('#choicesForm').removeClass('block')
//       }

//       $.ajax({
//         type: 'POST',
//         url: "{{ url('/store-quizze') }}",
//         data: {
//           _token: '{{ csrf_token() }}',
//           question: question,
//           dare_id: dare_id,
//         },
//         dataType: 'json',
//         encode: true,
//         beforeSend: function () {},
//         success: function (result) {},
//         error: function (data) {
//           $('#message').html('Some error')
//         },
//         complete: function () {},
//       }).done(function (result) {
//         if (result.success == true) {
//           location.reload()
//           $('#message').html(result.message)
//         } else {
//           $('#message').html(result.message)
//         }
//       })
//     }
//   })
// })
