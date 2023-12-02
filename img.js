async function fetchRandomImage5() {
    const response = await fetch('https://source.unsplash.com/random');
    const imageUrl = response.url;

 
    document.querySelector('#randomImage5').src = imageUrl;
  }

      fetchRandomImage5();
  
  document.querySelector('#randomImage5').addEventListener('click', fetchRandomImage);
  

async function fetchRandomImage6() {
    const response = await fetch('https://source.unsplash.com/random');
    const imageUrl = response.url;

 
    document.querySelector('#randomImage6').src = imageUrl;
  }