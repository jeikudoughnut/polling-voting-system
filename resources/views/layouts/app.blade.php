<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Online Polling System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        darkMode: 'class',
        theme: {
          extend: {
            colors: {
              dark: {
                50: '#f8fafc',
                100: '#f1f5f9',
                200: '#e2e8f0',
                300: '#cbd5e1',
                400: '#94a3b8',
                500: '#64748b',
                600: '#475569',
                700: '#334155',
                800: '#1e293b',
                900: '#0f172a',
              }
            }
          }
        }
      }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
      // Dark mode initialization
      (function() {
        const theme = localStorage.getItem('theme') || 'light';
        if (theme === 'dark') {
          document.documentElement.classList.add('dark');
        }
      })();
    </script>
  </head>
  <body class="bg-gray-50 dark:bg-dark-900 transition-colors duration-300">
    @yield('content')
    
    <script>
      // Dark mode toggle functionality
      function toggleDarkMode() {
        const html = document.documentElement;
        const isDark = html.classList.contains('dark');
        
        if (isDark) {
          html.classList.remove('dark');
          localStorage.setItem('theme', 'light');
        } else {
          html.classList.add('dark');
          localStorage.setItem('theme', 'dark');
        }
        
        // Update toggle button icon
        updateDarkModeIcon();
      }
      
      function updateDarkModeIcon() {
        const darkModeBtn = document.getElementById('darkModeToggle');
        const isDark = document.documentElement.classList.contains('dark');
        
        if (darkModeBtn) {
          const icon = darkModeBtn.querySelector('i');
          if (isDark) {
            icon.className = 'fas fa-sun text-yellow-500';
          } else {
            icon.className = 'fas fa-moon text-gray-600';
          }
        }
      }
      
      // Initialize dark mode icon when page loads
      document.addEventListener('DOMContentLoaded', function() {
        updateDarkModeIcon();
      });
    </script>
  </body>
</html>