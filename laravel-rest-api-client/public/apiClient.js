class ApiClient {
    constructor(baseUrl, token = null) {
        this.baseUrl = baseUrl; // pl. http://localhost:8000/api
        this.token = token;
    }

    setToken(token) {
        this.token = token;
    }

    async request(endpoint, method = 'GET', body = null) {
        const headers = {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        };

        if (this.token) {
            headers['Authorization'] = `Bearer ${this.token}`;
        }

        const response = await fetch(`${this.baseUrl}${endpoint}`, {
            method,
            headers,
            body: body ? JSON.stringify(body) : null,
        });

        if (!response.ok) {
            const error = await response.json().catch(() => ({}));
            throw new Error(error.message || `HTTP error ${response.status}`);
        }

        return response.json();
    }

    // --- Movie endpoints ---

    async getMovies(params = {}) {
        const query = new URLSearchParams(params).toString();
        return this.request(`/movies${query ? '?' + query : ''}`, 'GET');
    }

    async getMovie(id) {
        return this.request(`/movies/${id}`, 'GET');
    }

    async createMovie(data) {
        return this.request('/movies', 'POST', data);
    }

    async updateMovie(id, data) {
        return this.request(`/movies/${id}`, 'PUT', data);
    }

    async deleteMovie(id) {
        return this.request(`/movies/${id}`, 'DELETE');
    }

    // --- User endpoints ---

    async login(email, password) {
        const result = await this.request('/users/login', 'POST', { email, password });
        if (result.user?.token) {
            this.setToken(result.user.token);
        }
        return result;
    }

    async getUsers() {
        return this.request('/users', 'GET');
    }
}
