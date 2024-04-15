document.getElementById('searchButton').addEventListener('click', searchMusic);

function searchMusic() {
  const searchInput = document.getElementById('searchInput').value;
  const apiKey = '0816dcd0ac62e5ac64f9029426472708';
  fetch(`https://ws.audioscrobbler.com/2.0/?method=album.search&album=${searchInput}&api_key=${apiKey}&format=json`)
    .then(response => response.json())
    .then(data => {
      if (data.results && data.results.albummatches && data.results.albummatches.album) {
        displayResults(data.results.albummatches.album);
      } else {
        displayResults([]);
      }
    })
    .catch(error => {
      console.error('Error fetching data:', error);
    });
}

function displayResults(albums) {
  const resultsContainer = document.getElementById('results');
  resultsContainer.innerHTML = '';

  if (albums.length === 0) {
    resultsContainer.innerHTML = '<p>No results found.</p>';
    return;
  }

  albums.forEach(album => {
    const albumElement = document.createElement('div');
    albumElement.classList.add('album');

    const title = document.createElement('h3');
    title.textContent = album.name;

    const artist = document.createElement('p');
    artist.textContent = `Artist: ${album.artist}`;

    const imageUrl = album.image[2]['#text']; // Large image
    const image = document.createElement('img');
    image.src = imageUrl;
    image.alt = album.name;

    albumElement.appendChild(title);
    albumElement.appendChild(artist);
    albumElement.appendChild(image);

    resultsContainer.appendChild(albumElement);
  });
}

