const buttons = Array.from(document.querySelectorAll(".view-detail button"));
buttons.forEach((button) => {
    const row = button.parentElement.parentElement.parentElement;
    button.onclick = () => {
        var donationId, receiverId, donationStatus;

        Array.from(row.children).forEach((rowChild) => {
            if(rowChild.classList.contains("donation-id"))
                donationId = rowChild;
            else if(rowChild.classList.contains("receiver-id"))
                receiverId = rowChild;
            else if(rowChild.classList.contains("status"))
                donationStatus = rowChild;
        })

        window.location.assign("available-donation-detail.html");
    }
});