<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ config('app.name', 'Portfolio') }} – {{ $settings['name'] ?? 'John Loyd Laoingco' }}</title>
  <link rel="canonical" href="{{ url('/') }}"/>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          fontFamily: { display: ['Inter', 'system-ui', 'sans-serif'] },
          animation: {
            'float-slow': 'float 12s ease-in-out infinite',
            'fade-in-up': 'fadeInUp .7s ease both',
          },
          keyframes: {
            float: { '0%,100%': { transform: 'translateY(0)' }, '50%': { transform: 'translateY(-12px)' } },
            fadeInUp: { '0%': { opacity: 0, transform: 'translateY(8px)' }, '100%': { opacity: 1, transform: 'translateY(0)' } },
          }
        },
      },
    };
  </script>

  <!-- Alpine.js -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <style>
    html { scroll-behavior: smooth; }
    .backface-hidden { backface-visibility: hidden; -webkit-backface-visibility: hidden; }
    .reveal { opacity: 0; transform: translateY(10px); transition: opacity .5s ease, transform .5s ease; }
    .reveal.revealed { opacity: 1; transform: translateY(0); }
  </style>

  {{-- Dynamic OG using Settings profile image (fallback-safe) --}}
  @php
    $profile  = $settings['profile_image'] ?? null;
    $ogImage  = $profile ? asset('storage/'.$profile) : asset('images/profile.jpg');
    $name     = $settings['name'] ?? 'John Loyd Laoingco';
    $headline = $settings['headline'] ?? 'CS student & aspiring full-stack developer';
  @endphp
  <meta name="description" content="{{ $headline }}" />
  <meta property="og:title" content="{{ $name }} — Portfolio" />
  <meta property="og:description" content="{{ $headline }}" />
  <meta property="og:type" content="website" />
  <meta property="og:image" content="{{ $ogImage }}" />
  <meta name="twitter:card" content="summary_large_image" />
</head>

<body class="min-h-screen antialiased bg-white text-slate-900 dark:bg-slate-950 dark:text-slate-100">

  <!-- Decorative blobs (only show in dark to keep light clean) -->
  <div aria-hidden="true" class="pointer-events-none fixed inset-0 -z-10 hidden dark:block">
    <div class="absolute -top-32 -left-24 h-80 w-80 rounded-full blur-3xl opacity-30 animate-float-slow"
      style="background: radial-gradient(closest-side, rgba(59,130,246,.5), transparent)"></div>
    <div class="absolute -bottom-28 -right-24 h-80 w-80 rounded-full blur-3xl opacity-25 animate-float-slow"
      style="animation-delay:-6s; background: radial-gradient(closest-side, rgba(168,85,247,.45), transparent)"></div>
  </div>

  <!-- NAVBAR -->
  <nav x-data="{ open:false, scrolled:false, theme: localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark':'light') }"
       x-init="
         document.documentElement.classList.toggle('dark', theme==='dark');
         window.addEventListener('scroll',()=>{ scrolled = window.scrollY > 6 })
       "
       :class="scrolled ? 'bg-slate-100/80 dark:bg-black/60 backdrop-blur sticky top-0 shadow-sm' : 'bg-transparent'"
       class="w-full z-20 transition-colors">
    <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
      <a href="#" class="font-bold tracking-wide text-lg md:text-xl">{{ $name }}</a>

      <div class="flex items-center gap-2">
        <!-- Theme toggle -->
        <button
          class="hidden sm:inline-flex items-center gap-1 px-3 py-1.5 rounded-md text-sm border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800"
          x-on:click="
            theme = theme==='dark' ? 'light' : 'dark';
            localStorage.setItem('theme', theme);
            document.documentElement.classList.toggle('dark', theme==='dark');
          "
          x-text="theme==='dark' ? 'Light' : 'Dark'"
          aria-label="Toggle theme">
        </button>

        <!-- Mobile menu -->
        <button class="md:hidden p-2 rounded hover:bg-slate-100 dark:hover:bg-white/5" x-on:click="open = !open" aria-label="Toggle menu">
          <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>

        <ul class="hidden md:flex gap-6 text-sm">
          <li><a href="#about" class="hover:text-blue-600 dark:hover:text-blue-400 transition">About</a></li>
          <li><a href="#projects" class="hover:text-blue-600 dark:hover:text-blue-400 transition">Projects</a></li>
          <li><a href="#contact" class="hover:text-blue-600 dark:hover:text-blue-400 transition">Contact</a></li>
        </ul>
      </div>
    </div>
    <div x-show="open" x-transition class="md:hidden border-t border-slate-200 dark:border-slate-800">
      <ul class="px-6 py-3 space-y-2">
        <li><a href="#about" x-on:click="open=false" class="block py-2">About</a></li>
        <li><a href="#projects" x-on:click="open=false" class="block py-2">Projects</a></li>
        <li><a href="#contact" x-on:click="open=false" class="block py-2">Contact</a></li>
        <li>
          <button
            class="mt-2 w-full text-left px-3 py-2 rounded-md border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800"
            x-on:click="
              theme = theme==='dark' ? 'light' : 'dark';
              localStorage.setItem('theme', theme);
              document.documentElement.classList.toggle('dark', theme==='dark');
            "
          >
            Toggle <span x-text="theme==='dark' ? 'Light' : 'Dark'"></span> Mode
          </button>
        </li>
      </ul>
    </div>
  </nav>

  <main>

    <!-- HERO -->
    <section class="px-6 pt-24 pb-12">
      <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-10 items-center">
        <!-- Photo -->
        <div class="flex justify-center md:justify-start reveal">
          <div class="relative">
            <div class="absolute inset-0 rounded-full blur-2xl opacity-40 -z-10 hidden dark:block"
                 style="background: radial-gradient(closest-side, rgba(59,130,246,.35), transparent)"></div>
            <div class="relative p-1 rounded-full bg-slate-200 dark:bg-gradient-to-tr dark:from-blue-500 dark:via-sky-400 dark:to-purple-500">
              <img
                src="{{ $profile ? asset('storage/'.$profile) : asset('images/profile.jpg') }}"
                alt="Portrait of {{ $name }}"
                class="h-48 w-48 md:h-56 md:w-56 rounded-full object-cover bg-slate-100 dark:bg-slate-900"
                onerror="this.src='https://via.placeholder.com/280x280.png?text=Profile'"
                loading="eager"
              >
            </div>
          </div>
        </div>

        <!-- Text / CTAs -->
        <div class="text-center md:text-left reveal">
          <h1 class="mt-2 text-4xl md:text-5xl font-extrabold leading-tight">
            {{ $name }}
          </h1>
          <p class="mt-3 text-lg text-slate-600 dark:text-slate-300">
            {{ $headline }}
          </p>

          <div class="mt-6 flex flex-col sm:flex-row gap-3 sm:items-center">
            <a href="#projects"
               class="inline-flex justify-center px-5 py-3 rounded-full bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow shadow-blue-600/30">
              View Projects
            </a>
            <a href="#contact"
               class="inline-flex justify-center px-5 py-3 rounded-full border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-900 font-semibold">
              Contact Me
            </a>
          </div>

          <!-- socials -->
          <div class="mt-5 flex items-center gap-4 text-slate-500 dark:text-slate-400 justify-center md:justify-start">
            @if(!empty($settings['github_url']))
              <a href="{{ $settings['github_url'] }}" target="_blank" class="hover:text-slate-900 dark:hover:text-slate-200" aria-label="GitHub">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M12 2C6.477 2 2 6.486 2 12.021c0 4.425 2.865 8.18 6.839 9.504.5.093.682-.218.682-.486 0-.24-.009-.876-.014-1.72-2.782.607-3.369-1.342-3.369-1.342-.454-1.156-1.11-1.465-1.11-1.465-.908-.622.069-.61.069-.61 1.004.071 1.533 1.037 1.533 1.037.892 1.537 2.341 1.093 2.91.836.091-.65.35-1.094.636-1.346-2.22-.253-4.555-1.114-4.555-4.957 0-1.095.39-1.991 1.029-2.692-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.027a9.564 9.564 0 0 1 2.502-.337c.849.004 1.705.115 2.504.337 1.909-1.297 2.748-1.028 2.748-1.028.546 1.379.203 2.398.1 2.651.64.7 1.028 1.597 1.028 2.692 0 3.852-2.339 4.701-4.566 4.949.359.31.678.92.678 1.855 0 1.337-.012 2.418-.012 2.748 0 .27.18.582.688.483A10.03 10.03 0 0 0 22 12.02C22 6.486 17.523 2 12 2Z"/>
                </svg>
              </a>
            @endif
            @if(!empty($settings['linkedin_url']))
              <a href="{{ $settings['linkedin_url'] }}" target="_blank" class="hover:text-slate-900 dark:hover:text-slate-200" aria-label="LinkedIn">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M4.98 3.5C4.98 4.88 3.87 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1s2.48 1.12 2.48 2.5zM.5 8h4V23h-4V8zm7.5 0h3.8v2.1h.1c.5-1 1.8-2.1 3.7-2.1 3.9 0 4.6 2.6 4.6 6v8.9h-4v-7.9c0-1.9 0-4.3-2.6-4.3s-3 2-3 4.1V23h-4V8z"/>
                </svg>
              </a>
            @endif
          </div>
        </div>
      </div>

      <div class="max-w-6xl mx-auto mt-10">
        <div class="h-px bg-gradient-to-r from-transparent via-slate-200 dark:via-slate-700 to-transparent"></div>
      </div>
    </section>

    {{-- NEW: Animated Counters --}}
    @php $projectsCount = $projects->count(); @endphp
    <section class="px-6 py-8">
      <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white/70 dark:bg-slate-900/60 p-5 text-center">
          <div class="text-xs text-slate-500 dark:text-slate-400 mb-1">Projects Published</div>
          <div class="text-3xl font-extrabold tabular-nums" data-counter="{{ $projectsCount }}">0</div>
        </div>
        <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white/70 dark:bg-slate-900/60 p-5 text-center">
          <div class="text-xs text-slate-500 dark:text-slate-400 mb-1">Years Learning</div>
          <div class="text-3xl font-extrabold tabular-nums" data-counter="3">0</div>
        </div>
        <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white/70 dark:bg-slate-900/60 p-5 text-center">
          <div class="text-xs text-slate-500 dark:text-slate-400 mb-1">Coffees Consumed ☕</div>
          <div class="text-3xl font-extrabold tabular-nums" data-counter="125">0</div>
        </div>
      </div>
    </section>

    <!-- ABOUT -->
    <section id="about" class="px-6 py-12 max-w-4xl mx-auto reveal">
      <h2 class="text-2xl font-bold text-blue-700 dark:text-blue-400">About Me</h2>
      <div class="mt-4 rounded-2xl border border-slate-200 dark:border-white/10 bg-white/70 dark:bg-white/5 p-6">
        <p class="text-slate-700 dark:text-slate-300 leading-relaxed">
          I love exploring programming and building practical web apps. My current toolkit includes
          <span class="font-semibold">Laravel</span>, <span class="font-semibold">Blade</span>, and
          <span class="font-semibold">Tailwind CSS</span>. Always learning, always shipping.
        </p>
      </div>
    </section>

    <!-- PROJECTS -->
    <section id="projects" class="px-6 py-14 bg-slate-100/70 dark:bg-slate-900/60">
      <div class="max-w-6xl mx-auto">
        <div class="flex items-center justify-between mb-6 reveal">
          <h2 class="text-2xl font-bold text-blue-700 dark:text-blue-400">Featured Projects</h2>
          @auth
          <a href="{{ route('admin.projects.index') }}" class="text-sm text-slate-600 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200">Manage →</a>
          @endauth
        </div>

        @if($projects->isEmpty())
          <p class="text-slate-600 dark:text-slate-400 reveal">No projects yet.</p>
        @else
          <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($projects as $project)
              <!-- FLIP CARD -->
              <div class="relative [perspective:1200px] h-64 reveal">
                <div x-data="{ flipped:false }"
                     class="relative h-full w-full transition-transform duration-700 [transform-style:preserve-3d]"
                     :class="flipped ? '[transform:rotateY(180deg)]' : ''">

                  <!-- FRONT -->
                  <div class="absolute inset-0 rounded-2xl overflow-hidden border border-slate-200 dark:border-white/10 bg-white/80 dark:bg-white/5 backface-hidden">
                    @if($project->thumbnail)
                      <img src="{{ asset('storage/'.$project->thumbnail) }}" alt="{{ $project->title }}"
                           class="h-32 w-full object-cover" loading="lazy">
                    @endif

                    <div class="p-4">
                      <h3 class="text-lg font-semibold">{{ $project->title }}</h3>
                      @if($project->short_description)
                        <p class="mt-2 text-sm text-slate-700 dark:text-slate-300 line-clamp-3">{{ $project->short_description }}</p>
                      @endif

                      <div class="mt-3 flex items-center justify-between">
                        <span class="text-xs text-slate-500 dark:text-slate-400">Click flip →</span>
                        <button class="px-2.5 py-1 text-xs rounded-md border border-slate-300 dark:border-slate-600 hover:bg-slate-100 dark:hover:bg-slate-900"
                                x-on:click.stop="flipped = true" aria-label="Show project links">
                          Details
                        </button>
                      </div>
                    </div>
                  </div>

                  <!-- BACK -->
                  <div class="absolute inset-0 rounded-2xl overflow-hidden border border-blue-400/50 dark:border-blue-600/40 bg-blue-100/40 dark:bg-blue-600/10 p-4 backface-hidden [transform:rotateY(180deg)]">
                    <div class="h-full flex flex-col">
                      <h3 class="text-lg font-semibold text-blue-700 dark:text-blue-300">{{ $project->title }}</h3>

                      <div class="mt-3 space-y-2">
                        @if($project->github_url)
                          <a href="{{ $project->github_url }}" target="_blank" rel="noopener"
                             class="block text-sm px-3 py-2 rounded-md border border-slate-300 dark:border-slate-600 hover:bg-slate-100 dark:hover:bg-slate-900">
                            GitHub →
                          </a>
                        @endif
                        @if($project->live_url)
                          <a href="{{ $project->live_url }}" target="_blank" rel="noopener"
                             class="block text-sm px-3 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white shadow shadow-blue-600/30">
                            Live Demo →
                          </a>
                        @endif
                      </div>

                      <div class="mt-auto flex items-center justify-between">
                        <span class="text-xs text-slate-500 dark:text-slate-400">Click flip ↑</span>
                        <button class="px-2.5 py-1 text-xs rounded-md border border-slate-300 dark:border-slate-600 hover:bg-slate-100 dark:hover:bg-slate-900"
                                x-on:click.stop="flipped = false" aria-label="Back to project summary">
                          Back
                        </button>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            @endforeach
          </div>
        @endif
      </div>
    </section>

    <!-- CONTACT -->
    <section id="contact" class="px-6 py-14 max-w-3xl mx-auto text-center reveal">
      <h2 class="text-2xl font-bold text-blue-700 dark:text-blue-400">Contact Me</h2>
      <p class="mt-3 text-slate-700 dark:text-slate-300">Have a question or want to collaborate?</p>

      <div class="mt-6 flex items-center justify-center gap-3">
        <a href="mailto:{{ $settings['email'] ?? 'you@example.com' }}"
           class="px-5 py-3 rounded-full bg-purple-600 hover:bg-purple-700 text-white font-semibold shadow">
          Send Email
        </a>
        <a href="#projects"
           class="px-5 py-3 rounded-full border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-900 font-semibold">
          Browse Work
        </a>
      </div>
    </section>
  </main>

  <!-- Back to Top -->
  <button id="toTop"
          class="fixed bottom-5 right-5 hidden px-3 py-2 rounded-full bg-slate-200 text-slate-900 border border-slate-300 dark:bg-slate-800/80 dark:text-slate-100 dark:border-slate-700 text-xs backdrop-blur hover:bg-slate-100 dark:hover:bg-slate-700"
          aria-label="Back to top"
          onclick="window.scrollTo({top:0, behavior:'smooth'})">
    ↑ Top
  </button>

  <footer class="py-8 text-center text-slate-600 dark:text-slate-400 text-sm border-t border-slate-200 dark:border-slate-800/60">
    © {{ date('Y') }} {{ $name }} — All Rights Reserved.
  </footer>

  <!-- Tiny scroll-reveal + counters + toTop -->
  <script>
    (function () {
      // reveal
      const els = Array.from(document.querySelectorAll('.reveal'));
      const toTop = document.getElementById('toTop');

      const io = new IntersectionObserver((entries) => {
        entries.forEach(e => {
          if (e.isIntersecting) {
            e.target.classList.add('revealed');
            io.unobserve(e.target);
          }
        });
      }, { threshold: 0.12 });

      els.forEach(el => io.observe(el));

      // toTop visibility
      window.addEventListener('scroll', () => {
        if (window.scrollY > 500) {
          toTop.classList.remove('hidden');
        } else {
          toTop.classList.add('hidden');
        }
      }, { passive: true });

      // counters
      const counters = document.querySelectorAll('[data-counter]');
      const ci = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (!entry.isIntersecting) return;
          const el = entry.target;
          const target = parseInt(el.getAttribute('data-counter'), 10) || 0;
          let start = 0;
          const dur = 800;
          const startTs = performance.now();
          const step = (now) => {
            const p = Math.min(1, (now - startTs) / dur);
            const val = Math.floor(start + (target - start) * p);
            el.textContent = val.toLocaleString();
            if (p < 1) requestAnimationFrame(step);
          };
          requestAnimationFrame(step);
          ci.unobserve(el);
        });
      }, { threshold: 0.6 });
      counters.forEach(c => ci.observe(c));
    })();
  </script>
</body>
</html>
