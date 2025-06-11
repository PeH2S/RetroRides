import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

const echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY || 'c315c4e2f577feb87dce',
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER || 'sa1',
    forceTLS: true,
    enabledTransports: ['ws', 'wss']
});

window.Echo = echo; 

// Debugging
echo.connector.pusher.connection.bind('connected', () => {
    console.log('Conectado ao Pusher!');
});
