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
                `;

                tableBody.appendChild(row);
            });
        })

        .catch(error => {
            console.error("Fetch error:", error);
        });
});
