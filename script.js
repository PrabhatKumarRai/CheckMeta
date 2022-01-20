//Toggle Original Response section
const link = document.querySelector(".original-response #show-original-response-link");
const originalResponseContentBody = document.querySelector(".original-response .content-body");
link.addEventListener('click', function(e){
    e.preventDefault();
    originalResponseContentBody.classList.toggle('show');            
});