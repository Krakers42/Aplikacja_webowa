document.addEventListener('DOMContentLoaded', () => {
    const tableBody = document.querySelector('#users-table');
    if (!tableBody) return;

    fetch('getAllUsers')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error ${response.status}`);
            }
            return response.json();
        })

        .then(users => {
            const tableBody = document.querySelector('#users-table');
            tableBody.innerHTML = '';

            users.forEach(user => {
                const row = document.createElement('tr');

                row.innerHTML = `
                    <td>${user.name}</td>
                    <td>${user.surname}</td>
                    <td>${user.email}</td>
                    <td>${user.role}</td>
                    <td>${user.id_user}</td>
                    <td><button class="delete-btn" data-id="${user.id_user}">Delete</button></td>
                `;

                tableBody.appendChild(row);
            });
        })

        .catch(error => {
            console.error("Fetch error:", error);
        });
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('delete-btn')) {
        const id = e.target.getAttribute('data-id');

        if (confirm("Are you sure you want to delete this user?")) {
            fetch('deleteUser', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `id_user=${id}`
            })
                .then(res => res.json())
                .then(data => {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    } else if (data.success) {
                        location.reload();
                    } else {
                        alert("Error: " + (data.error || "Unknown error"));
                    }
                });
        }
    }
});
