<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} – Portfolio</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-900 via-black to-gray-900 text-gray-100">

    {{-- NAVBAR --}}
    <nav class="flex justify-between items-center px-8 py-4 bg-black/40 backdrop-blur-sm fixed w-full z-20">
        <h1 class="text-xl md:text-2xl font-bold tracking-wide">John Loyd Laoingco</h1>

        <ul class="hidden md:flex gap-6 text-sm md:text-base">
            <li><a href="#about" class="hover:text-blue-400 transition">About</a></li>
            <li><a href="#projects" class="hover:text-blue-400 transition">Projects</a></li>
            <li><a href="#contact" class="hover:text-blue-400 transition">Contact</a></li>
        </ul>
    </nav>

    <main class="pt-28">

        {{-- HERO --}}
        <section class="px-8 py-16 text-center max-w-3xl mx-auto">
            <h2 class="text-4xl md:text-5xl font-extrabold mb-4 leading-tight">
                Hello, I'm
            </h2>

            <h2 class="text-4xl md:text-5xl font-extrabold mb-6">
                <span class="bg-gradient-to-r from-blue-400 to-purple-500 bg-clip-text text-transparent">
                    John Loyd Laoingco
                </span>
            </h2>

            <p class="text-lg text-gray-300 mb-8">
                A CS student and aspiring full-stack developer who loves building web experiences and learning new things.
            </p>

            <a href="#projects"
               class="inline-block px-8 py-3 bg-blue-600 rounded-full text-base font-semibold hover:bg-blue-700 transition">
                View My Projects
            </a>
        </section>

        {{-- ABOUT --}}
        <section id="about" class="px-8 py-12 max-w-3xl mx-auto">
            <h3 class="text-3xl font-bold mb-4 text-blue-400">About Me</h3>

            <div class="bg-white/5 p-6 rounded-xl shadow border border-white/10">
                <p class="text-gray-300 leading-relaxed">
                    Hello! I am <b>John Loyd Laoingco</b>, a computer science student who enjoys exploring
                    programming, creating web applications, and continuously improving my skills.
                </p>
            </div>
        </section>

        {{-- PROJECTS (from CMS) --}}
        <section id="projects" class="px-8 py-12 bg-gray-900/60">
            <div class="max-w-5xl mx-auto">
                <h3 class="text-3xl font-bold mb-6 text-center text-blue-400">My Projects</h3>

                @if($projects->isEmpty())
                    <p class="text-center text-gray-400">
                        No projects yet. Log in to the admin panel to add your first project.
                    </p>
                @else
                    <div class="grid md:grid-cols-3 gap-6">
                        @foreach($projects as $project)
                            <div class="bg-white/5 p-5 rounded-xl shadow border border-white/10 flex flex-col">
                                {{-- Thumbnail (optional) --}}
                                @if($project->thumbnail)
                                    <img
                                        src="{{ asset('storage/' . $project->thumbnail) }}"
                                        alt="{{ $project->title }}"
                                        class="rounded-lg mb-4 object-cover h-40 w-full"
                                    >
                                @endif

                                <h4 class="text-xl font-semibold mb-2">
                                    {{ $project->title }}
                                </h4>

                                @if($project->short_description)
                                    <p class="text-gray-300 text-sm mb-4">
                                        {{ $project->short_description }}
                                    </p>
                                @endif

                                <div class="mt-auto flex flex-wrap gap-2">
                                    @if($project->github_url)
                                        <a href="{{ $project->github_url }}" target="_blank"
                                           class="text-xs px-3 py-1 border border-gray-500 rounded-full hover:bg-gray-800">
                                            GitHub
                                        </a>
                                    @endif

                                    @if($project->live_url)
                                        <a href="{{ $project->live_url }}" target="_blank"
                                           class="text-xs px-3 py-1 bg-blue-600 rounded-full hover:bg-blue-700">
                                            Live Demo
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        {{-- CONTACT --}}
        <section id="contact" class="px-8 py-12 max-w-3xl mx-auto text-center">
            <h3 class="text-3xl font-bold mb-4 text-blue-400">Contact Me</h3>
            <p class="text-gray-300 mb-6">
                Have a question or want to collaborate? Feel free to reach out.
            </p>

            <a href="mailto:you@example.com"
               class="inline-block px-8 py-3 bg-purple-600 rounded-full text-base font-semibold hover:bg-purple-700 transition">
                Send Email
            </a>
        </section>
    </main>

    {{-- FOOTER --}}
    <footer class="py-6 text-center text-gray-400 border-t border-gray-800 text-sm">
        © {{ date('Y') }} John Loyd Laoingco — All Rights Reserved.
    </footer>

</body>
</html>
