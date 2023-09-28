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
        
        if(document.title === "Donation History")
            window.location.assign("donation-history-detail.php?id=" + donationId.innerHTML + "&receiverId=" + receiverId.innerHTML + "&status=" + donationStatus.innerHTML);
        else if (document.title === "Receipt History")
            window.location.assign("receipt-history-detail.html?id=" + donationId.innerHTML + "&receiverId=" + receiverId.innerHTML + "&status=" + donationStatus.innerHTML);
    }
});