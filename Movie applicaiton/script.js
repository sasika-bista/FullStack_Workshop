const API_URL = "http://localhost:3000/movies";
const movieListDiv = document.getElementById("movie-list");

let allMovies = [];

function renderMovies(moviesToDisplay) {
  movieListDiv.innerHTML = "";
  if (moviesToDisplay.length === 0) {
    console.log("no movies");
    movieListDiv.innerHTML = "<p>No movies found matching your criteria.</p>";
    return;
  }

  moviesToDisplay.forEach((movie) => {
    const movieElement = document.createElement("div");
    movieElement.classList.add("movie-iteam");
    // console.log(movie.id + 1, "hi");

    movieElement.innerHTML = `<p><strong>${movie.title}</strong>(${movie.year})-${movie.genre}</p>
        <button onclick="editMoviePrompt(${movie.id}, '${movie.title}', ${movie.year},'${movie.genre}')">Edit</button>
        <button onclick="deleteMovie(${movie.id})">Delete</button>`;
    movieListDiv.appendChild(movieElement);
  });
}

function fetchMovies() {
  fetch(API_URL)
    .then((response) => response.json())
    .then((movies) => {
      allMovies = movies;
      renderMovies(allMovies);
      console.log("araay ho", allMovies);
    })
    .catch((error) => console.error("Error fetching Movies:", error));
}

fetchMovies();

const searchInput = document.getElementById("search-input");
const form = document.getElementById("add-movie-form");

searchInput.addEventListener("input", function () {
  const searchTerm = searchInput.value.toLowerCase();
  console.log(searchTerm);

  const filteredMovies = allMovies.filter((movie) => {
    const titleMatch = movie.title.toLowerCase().includes(searchTerm);
    const genreMatch = movie.genre.toLowerCase().includes(searchTerm);

    return titleMatch || genreMatch;
  });

  renderMovies(filteredMovies);
});

// post Method
form.addEventListener("submit", function (event) {
  event.preventDefault();

  const newMovie = {
    title: document.getElementById("title").value,
    genre: document.getElementById("genre").value,
    year: parseInt(document.getElementById("year").value),
  };
  console.log(newMovie);

  fetch(API_URL, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(newMovie),
  })
    .then((response) => {
      if (!response.ok) throw new Error("Failed to load the movies");
      return response.json();
    })
    .then(() => {
      this.reset();
      fetchMovies();
    })
    .catch((error) => console.log("Error adding movies:", error));
});

// put Method

function editMoviePrompt(id, currentTitle, currentYear, currentGenre) {
  const newTitle = prompt("Enter new Title:", currentTitle);
  const newYearStr = prompt("Enter new year:", currentYear);
  const newGenre = prompt("enter new Genre:", currentGenre);

  if (newTitle && newYearStr && newGenre) {
    const updatedMovie = {
      id: id,
      title: newTitle,
      year: parseInt(newYearStr),
      genre: newGenre,
    };
    console.log(updatedMovie);
    updateMovie(id, updatedMovie);
  }
}

function updateMovie(movieId, updatedMovieData) {
  fetch(`${API_URL}/${movieId}`, {
    method: "PUT",
    headers: { "Content-Type": "application.json" },
    body: JSON.stringify(updatedMovieData),
  })
    .then((response) => {
      if (!response.ok) throw new Error("Failed to update the movie");
      return response.json();
    })
    .then(() => {
      fetchMovies();
    })
    .catch((error) => console.error("Error fetching movies:", error));
}

// Delete Method

function deleteMovie(movieID) {
  console.log("ma eta chu", movieID);
  fetch(`${API_URL}/${movieID}`, {
    method: "DELETE",
  })
    .then((response) => {
      if (!response.ok) throw new Error("failed to delete the movie");
      fetchMovies();
    })
    .catch((error) => console.log("Error deleteing movies:", error));
}
