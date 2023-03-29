// js listener to swap out the main image when a thumbnail is clicked
const thumbnailImages = document.querySelectorAll('.inv-thumb-img');

thumbnailImages.forEach(function(thumbnailImage) {
    thumbnailImage.addEventListener('click', function() {
        const mainImage = document.querySelector('#inv-img');
        const thumbnailSrc = this.src;
        const mainSrc = thumbnailSrc.replace('-tn', ''); // Remove the "-tn" to get the larger image
        mainImage.src = mainSrc;
    });
});
