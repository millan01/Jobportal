const image = document.querySelector(".imagesection img");
    input =document.querySelector("input");

    input.addEventListener("change",() =>{
        image.src = URL.createObjectURL(input.files[0]);
    });