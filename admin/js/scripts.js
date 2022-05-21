$(document).ready(function () {
  $("#summernote").summernote({
    height: 200,
  });

  const selectAll = document.getElementById('selectAllBoxes');
  
  selectAll.addEventListener('click', () => {
      const checkBoxes = document.getElementsByClassName('checkBoxes');
      if (selectAll.checked === true) {
            for(const checkBox of checkBoxes) {
                checkBox.checked = true;
            }
        } else {
            for(const checkBox of checkBoxes) {
                checkBox.checked = false;
            }
        }
      }
  )
});
