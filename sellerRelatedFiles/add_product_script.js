// document.querySelectorAll('.upload-box input[type="file"]').forEach(input => {
//     input.addEventListener('change', () => {
//       const file = input.files[0];
//       if (!file) return;
//       const idx = input.dataset.index;
//       const preview = document.getElementById(`preview-${idx}`);
//       const reader = new FileReader();
//       reader.onload = e => {
//         preview.src = e.target.result;
//         preview.style.display = 'block';
//       };
//       reader.readAsDataURL(file);

//       // show filename
//         filenameDiv.textContent = file.name;

//     console.log("22222222222222");

//     });
//   });


// script.js
document.querySelectorAll('.upload-box input[type="file"]').forEach(input => {
    input.addEventListener('change', () => {
      const file = input.files[0];
      if (!file) return;
  
      const idx = input.dataset.index;  // "0", "1", etc.
      const preview = document.getElementById(`preview-${idx}`);
    //   const filenameDiv = document.getElementById(`filename-${idx}`);
    //   if (!filenameDiv) {
    //     console.warn(`No element with id filename-${idx} found.`);
    //     return;
    //   }
  
      // Show thumbnail
      const reader = new FileReader();
      reader.onload = e => {
        if (preview) {
          preview.src = e.target.result;
          preview.style.display = 'block';
        }
      };
      reader.readAsDataURL(file);
  
    });
  });
  