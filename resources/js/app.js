require('./bootstrap');


const toggleFavourite = (id) => {
    axios.put(`/posts/${id}/favourite`)
        .then((response) => {

            let favouriteButton = document.getElementById('favourite-button')

            favouriteButton.innerText =
                response.data.favourite
                    ? 'В избранное'
                    : 'Добавить в избранное'
        })

}

document.addEventListener('DOMContentLoaded', () => {
    let favouriteButton = document.getElementById('favourite-button')

    if (!favouriteButton)
        return
    favouriteButton.addEventListener('click', () => {
        let id = favouriteButton.dataset.id ?? null
        if (id)
            toggleFavourite(id)
    })
})

