function updateDistance() {
    fetch('/includes/get_distance.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('distance').innerText = `${data.distance} cm`;
        })
        .catch(error => console.error('Error fetching humidity:', error));
}
setInterval(updateDistance, 1000);