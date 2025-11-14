<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} – Portfolio</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        /* Custom scroll behavior */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-900 via-black to-gray-900 text-gray-100">

    {{-- NAVBAR --}}
    <nav class="flex justify-between items-center px-8 py-6 bg-black/20 backdrop-blur-sm fixed w-full z-20">
        <h1 class="text-2xl font-bold tracking-wide">John Loyd Laoingco</h1>

        <ul class="hidden md:flex gap-8 text-lg">
            <li><a href="#about" class="hover:text-blue-400 transition">About</a></li>
            <li><a href="#projects" class="hover:text-blue-400 transition">Projects</a></li>
            <li><a href="#contact" class="hover:text-blue-400 transition">Contact</a></li>
        </ul>
    </nav>

    {{-- HERO SECTION --}}
    <section class="px-8 py-36 text-center" data-aos="fade-up">
        <h2 class="text-5xl md:text-7xl font-extrabold mb-4 leading-tight">
            Hello, I'm  
        </h2>

        <h2 class="text-5xl md:text-7xl font-extrabold mb-6">
            <span class="bg-gradient-to-r from-blue-400 to-purple-500 bg-clip-text text-transparent">
                John Loyd Laoingco
            </span>
        </h2>

        <p class="text-xl text-gray-300 max-w-3xl mx-auto mb-10">
            A passionate **IT Student**, aspiring **Full-Stack Developer**,  
            and someone who loves **building digital experiences**.
        </p>

        <div class="mt-6">
            <a href="#projects"
               class="px-10 py-4 bg-blue-600 rounded-full text-lg font-semibold hover:bg-blue-700 transition shadow-lg shadow-blue-600/30">
                View My Projects
            </a>
        </div>
    </section>

    {{-- ABOUT --}}
    <section id="about" class="px-8 py-24 max-w-4xl mx-auto" data-aos="fade-right">
        <h3 class="text-4xl font-bold mb-6 text-blue-400">About Me</h3>
        <div class="bg-white/5 p-8 rounded-xl backdrop-blur-sm shadow-lg border border-white/10">
            <p class="text-gray-300 text-lg leading-relaxed">
                Hello! I am <b>John Loyd Laoingco</b>, a dedicated IT student who enjoys exploring
                the world of programming, creating web applications, learning new technologies, and improving my skills.
                <br><br>
                I aim to become a skilled full-stack developer and create meaningful projects that make life easier.
                I love experimenting with **Laravel**, **Tailwind**, **JavaScript**, and more.
            </p>
        </div>
    </section>

    {{-- PROJECTS --}}
    <section id="projects" class="px-8 py-24 bg-gray-800/40 backdrop-blur-sm" data-aos="fade-up">
        <h3 class="text-4xl font-bold mb-10 text-center text-blue-400">My Projects</h3>

        <div class="grid md:grid-cols-3 gap-10 max-w-6xl mx-auto">

            {{-- PROJECT CARD --}}
            <div class="bg-white/10 p-6 rounded-xl shadow-lg hover:scale-105 hover:shadow-blue-500/20 transition border border-white/10"
                data-aos="zoom-in">
                <h4 class="text-2xl font-semibold mb-3">Project One</h4>
                <p class="text-gray-300 mb-4">A web application created to solve a real-world problem.</p>
                <a href="#" class="text-blue-400 hover:underline">View More →</a>
            </div>

            <div class="bg-white/10 p-6 rounded-xl shadow-lg hover:scale-105 hover:shadow-purple-500/20 transition border border-white/10"
                data-aos="zoom-in" data-aos-delay="200">
                <h4 class="text-2xl font-semibold mb-3">Project Two</h4>
                <p class="text-gray-300 mb-4">Something cool I built using Laravel and Tailwind CSS.</p>
                <a href="#" class="text-blue-400 hover:underline">View More →</a>
            </div>

            <div class="bg-white/10 p-6 rounded-xl shadow-lg hover:scale-105 hover:shadow-pink-500/20 transition border border-white/10"
                data-aos="zoom-in" data-aos-delay="400">
                <h4 class="text-2xl font-semibold mb-3">Project Three</h4>
                <p class="text-gray-300 mb-4">A fun project showcasing my creativity and skills.</p>
                <a href="#" class="text-blue-400 hover:underline">View More →</a>
            </div>

        </div>
    </section>

    {{-- CONTACT --}}
    <section id="contact" class="px-8 py-24 max-w-3xl mx-auto text-center" data-aos="fade-left">
        <h3 class="text-4xl font-bold mb-6 text-blue-400">Contact Me</h3>
        <p class="text-gray-300 text-lg mb-8">
            Have a question? Want to collaborate?  
            Feel free to reach out!
        </p>

        <a href="mailto:you@example.com"
           class="px-10 py-4 bg-purple-600 rounded-full text-lg font-semibold hover:bg-purple-700 transition shadow-lg shadow-purple-600/30">
            Send Email
        </a>
    </section>

    {{-- FOOTER --}}
    <footer class="py-10 text-center text-gray-400 border-t border-gray-700">
        © {{ date('Y') }} John Loyd Laoingco — All Rights Reserved.
    </footer>

    <!-- AOS Animation Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
        });
    </script>

</body>
</html>
