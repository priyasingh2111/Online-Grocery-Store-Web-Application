function getDate()
{
    const date = new Date();
    return date;
}

function viewCart() 
{
    window.location.href = "Cart.html"; 
}

function clearcart()
{
    sessionStorage.clear();
}