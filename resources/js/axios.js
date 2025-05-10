import axios from 'axios';

// Cria uma instância customizada do Axios
const api = axios.create({
    baseURL: import.meta.env.VITE_API_BASE_URL || 'http://localhost:8000',
    withCredentials: true,
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
    }
});

// Interceptadores para tratamento global
api.interceptors.request.use(config => {
    // Adiciona token se existir (para Sanctum/Laravel)
    const token = localStorage.getItem('token') || sessionStorage.getItem('token');
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
}, error => {
    return Promise.reject(error);
});

api.interceptors.response.use(response => {
    return response;
}, error => {
    // Tratamento global de erros
    if (error.response?.status === 401) {
        window.location.href = '/login';
    }
    if (error.response?.status === 419) { // CSRF token mismatch
        window.location.reload();
    }
    return Promise.reject(error);
});

export default api;