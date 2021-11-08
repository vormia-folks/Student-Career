// Generate function which 
// 1. accept the url
// Then ask user to confirm the action before proceeding further
// 2. if user confirms, then proceed to the url
// 3. if user cancels, then do nothing
function confirmAction(url) {
    if (confirm("Are you sure you want to proceed?")) {
        window.location.href = url;
    }

    console.log(url);
}