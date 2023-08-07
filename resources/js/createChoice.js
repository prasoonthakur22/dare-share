// function handleFile(file) {
//     console.log(file)
//     if (
//         file.type == 'image/jpeg' ||
//         file.type == 'image/png' ||
//         file.type == 'image/jpg'
//     ) {
//         let reader = new FileReader()
//         reader.onload = function(event) {
//             $('#fileInfoBox').addClass('show')
//             $('#fileInfoBox').removeClass('hide')
//             $('#previewImg').attr('src', event.target.result)
//         }
//         reader.readAsDataURL(file)
//     } else {
//         $('#message').html('Please Upload Images Only')
//     }
// }

// window.addEventListener('load', function() {
//     myFileList.addEventListener('drop', dropHandler, false)
//     myFileList.addEventListener(
//         'dragover',
//         function(ev) {
//             ev.preventDefault()
//         },
//         false,
//     )

//     function dropHandler(ev) {
//         ev.preventDefault()
//         var filelist = ev.dataTransfer.files
//         for (var i = 0, f;
//             (f = filelist[i]); i++) {
//             var reader = new FileReader()
//             reader.onload = (function(theFile) {
//                 handleFile(theFile)
//                 document.querySelector('#fileup').files = theFile;
//             })(f)
//             break
//         }
//     }
// })

// $(document).ready(function() {
//     var readURL = function(input) {
//         if (input.files && input.files[0]) {
//             handleFile(input.files[0])
//         }
//     }
//     $('.file-upload').on('change', function() {
//         readURL(this)
//     })
//     $('.upload-button').on('click', function() {
//         $('.file-upload').click()
//     })
// })



// $(document).ready(function() {
//     $('#choicesForm').on('submit', function(e) {
//         e.preventDefault()
//         if (true) {
//             let answer = $('#answer').val();
//             if (!answer) {
//                 $('#message').html("Please enter Answer");
//                 $('#message').addClass('block')
//                 $('#message').removeClass('hidden')
//                 return null;
//             }

//             var file = $('#fileup')[0].files['0']
//             let quizze_id = $('#quizze_id').val();
//             var postData = new FormData()
//             postData.append('answer_image', file)
//             postData.append('answer', answer)
//             postData.append('quizze_id', quizze_id)

//             $.ajax({
//                 type: "POST",
//                 url: "{{ url('/store-choice') }}",
//                 data: postData,
//                 cache: false,
//                 contentType: false,
//                 processData: false,
//                 beforeSend: function() {
//                 },
//                 success: function(result) {},
//                 error: function(data) {
//                     $('#message').html("Some error");
//                 },
//                 complete: function() {
//                     $('#message').removeClass('hidden')
//                 },
//             }).done(function(result) {
//                 if (result.success == true) {
//                     $('#message').html(result.message);
//                 } else {
//                     $('#message').html(result.message);
//                 }
//             });
//         }
//     });
// });
