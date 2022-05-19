<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" type="image/x-png">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    
    {{-- Material icons --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>{{ $title ?? config('app.name') }}</title>
</head>
<body>
    {{-- Header --}}
    <header>
        <div class="container py-3">
            <div class="row align-items-center">
                {{-- Logo --}}
                <div class="col-2">
                    <a href="{{ route('home') }}">
                        <h1 class="fw-bold text-primary fs-2 m-0">Larastripe</h1>                    
                    </a>
                </div>

                {{-- Search bar --}}
                <div class="col-7 ps-4 d-flex align-items-center">
                    <form class="w-100" action="{{ route('search') }}" method="GET">
                        <input type="text" name="query" class="form-control" placeholder="Titre, auteur, mot clé" aria-label="Username" aria-describedby="basic-addon1">
                    </form>
                        
                </div>
                {{-- User menu --}}
                <div class="col-3 d-flex justify-content-end align-items-center">
                    {{-- Pinned items --}}
                    <a class="d-flex me-2" href="" type="button">
                        <span class="material-icons">push_pin</span>
                    </a>
                    {{-- Shopping cart --}}
                    <a class="d-flex me-2" href="" type="button">
                        <span class="material-icons">shopping_cart</span>
                        {{-- @if (count(Cart::content()) > 0)
                            <span class="badge rounded-pill bg-danger">
                                {{ count(Cart::content()) }}
                            </span>                                
                        @endif --}}
                    </a>
                    {{-- Login button --}}
                    @auth
                        <a class="text-black dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->username }}
                        </a>                            
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}">Profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form class="logout-form" method="POST" action="">
                                    @csrf
                                    <a class="dropdown-item" href="#" onclick="document.querySelector('.logout-form').submit()">Déconnexion</a>
                                </form>
                            </li>
                        </ul>
                    @else
                        <a class="d-flex align-items-center" href="">
                            <span class="material-icons">account_circle</span>
                            <span class="ps-2">Connexion</span>
                        </a>
                    @endauth

                </div>
            </div>

        </div>
    </header>

    {{-- Categories --}}
    @isset($showCategories)
        <div class="container">
            <div class="row">
                <aside class="col-2">
                    <x-categories-list />
                </aside>
                
                <main class="col-10 ps-4 pt-3">
                    {{ $slot }}
                </main>
            </div>
        </div>
        
    @else
        <div class="container">
            <div class="row">
                <main class="col pt-3">
                    {{ $slot }}
                </main>
            </div>
        </div>
    @endisset
    

    {{-- Footer --}}
    <footer class="mt-4 bg-gray">
        <div class="container">
            {{-- icons row --}}
            <div class="row">
                {{-- telephone icon --}}
                <div class="col-3">
                    <div class="d-flex justify-content-center my-4">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.82667 14.3867C10.7467 18.16 13.84 21.24 17.6133 23.1733L20.5467 20.24C20.9067 19.88 21.44 19.76 21.9067 19.92C23.4 20.4133 25.0133 20.68 26.6667 20.68C27.4 20.68 28 21.28 28 22.0133V26.6667C28 27.4 27.4 28 26.6667 28C14.1467 28 4 17.8533 4 5.33333C4 4.6 4.6 4 5.33333 4H10C10.7333 4 11.3333 4.6 11.3333 5.33333C11.3333 7 11.6 8.6 12.0933 10.0933C12.24 10.56 12.1333 11.08 11.76 11.4533L8.82667 14.3867Z" fill="black"/></svg>
                    </div>
                </div>

                <div class="col-3"></div>
                <div class="col-3"></div>

                {{-- helpdesk icon --}}
                <div class="col-3">
                    <div class="d-flex justify-content-center my-4">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 12.052C6 6.5 10.478 2 16 2C21.522 2 26 6.5 26 12.052V19.232C26 20.816 24.72 22.102 23.142 22.102H20.286C20.0979 22.1015 19.9118 22.0639 19.7383 21.9915C19.5648 21.919 19.4072 21.8131 19.2746 21.6798C19.142 21.5464 19.037 21.3882 18.9655 21.2143C18.894 21.0404 18.8575 20.8541 18.858 20.666V14.924C18.858 14.13 19.498 13.488 20.286 13.488H23.858V12.052C23.858 7.69 20.338 4.152 16 4.152C11.66 4.152 8.142 7.69 8.142 12.052V13.488H11.714C12.504 13.488 13.142 14.13 13.142 14.924V20.666C13.142 21.46 12.502 22.102 11.714 22.102H8.86C8.61846 22.1028 8.37783 22.0725 8.144 22.012V22.462C8.144 24.172 9.466 25.572 11.14 25.684L11.36 25.692H12.97C13.1902 25.0638 13.6 24.5195 14.1427 24.134C14.6854 23.7486 15.3343 23.541 16 23.54C16.4234 23.5408 16.8424 23.6251 17.2332 23.788C17.6239 23.9509 17.9787 24.1893 18.2773 24.4895C18.5758 24.7897 18.8122 25.1458 18.9729 25.5375C19.1337 25.9291 19.2156 26.3486 19.214 26.772C19.214 28.554 17.774 30 16 30C14.6 30 13.41 29.1 12.968 27.846H11.36C9.98481 27.8426 8.66333 27.3118 7.66795 26.3629C6.67256 25.414 6.07914 24.1195 6.01 22.746L6 22.464V12.052Z" fill="black"/>
                            </svg>
                            
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3 py-4 pe-5">
                    <div>
                        <span class="h4"><a class="text-reset" href="tel:+312345678">031 234 56 78</a></span>
                    </div>

                    <div class="my-4">
                        <p>Vous avez des questions ou vous souhaitez commander par téléphone? Notre service clients est là pour vous aider.</p>
                    </div>

                    <div>
                        <p>Lundi &ndash; vendredi<br>08h00 &ndash; 18h00</p>
                    </div>
                </div>

                <div class="col-3 pt-4">
                    <p class="fw-bold py4">L'entreprise</p>
                    <ul class="list-unstyled">
                        <li class="my-2"><a class="text-reset" href="">Livraison et retrait</a></li>
                        <li class="my-2"><a class="text-reset" href="">Modes de paiement</a></li>
                        <li class="my-2"><a class="text-reset" href="">Contact</a></li>
                        <li class="my-2"><a class="text-reset" href="">FAQ</a></li>
                        <li class="my-2"><a class="text-reset" href="">Mentions légales</a></li>
                    </ul>
                </div>
                <div class="col-3"></div>

                <div class="col-3 pt-4">
                    <p class="fw-bold mb-1">Aide et contact</p>
                    <p>Notre service Helpedesk est disponible 24/24 pour vous aider.</p>
                    <a href="{{ url('/contact') }}" class="btn w-100 btn-primary">Contact</a>
                </div>

            </div>

            <div class="row">
                <div class="col-9 py-4">
                    <strong class="fs-6 my-2">Modes de paiement</strong>
                    <p class="my-1">Vous trouverez plus d'infos dans l'espace service sous modes de paiement.</p>
                    <div class="my-3">
                        {{-- mastercard --}}
                        <svg class="me-3" width="60px" height="40px" viewBox="0 0 60 40"><g fill-rule="nonzero" fill="none"><rect fill="#000" width="60" height="40" rx="3"></rect><path fill="#FF5F00" d="M25 26.29h10.35V7.69H25.01z"></path><path d="M25.66 16.99a11.8 11.8 0 014.52-9.3 11.83 11.83 0 100 18.6 11.8 11.8 0 01-4.52-9.3" fill="#EB001B"></path><path d="M48.95 24.32v-.46h-.12l-.14.31-.14-.31h-.12v.46h.08v-.35l.13.3h.1l.12-.3v.35h.09zm-.76 0v-.38h.15v-.08h-.4v.08h.16v.38h.09zm1.12-7.33a11.83 11.83 0 01-19.13 9.3 11.8 11.8 0 000-18.6A11.83 11.83 0 0149.31 17z" fill="#F79E1B"></path><g fill="#FFF"><path d="M18.4 34.82V32.9c0-.75-.45-1.23-1.22-1.23-.39 0-.8.13-1.1.55a1.12 1.12 0 00-1.02-.55c-.32 0-.64.1-.9.45v-.38h-.67v3.1h.68V33.1c0-.55.28-.8.73-.8.45 0 .68.29.68.8v1.71h.67v-1.7c0-.56.32-.81.74-.81.44 0 .67.29.67.8v1.71h.74zm9.96-3.1h-1.09v-.93h-.67v.94h-.61v.6h.6v1.43c0 .7.3 1.13 1.06 1.13.3 0 .61-.1.84-.23l-.2-.58c-.19.13-.41.16-.57.16-.32 0-.45-.2-.45-.51v-1.4h1.09v-.6zm5.7-.06a.9.9 0 00-.8.45v-.38h-.67v3.1h.67v-1.75c0-.52.23-.8.64-.8.13 0 .29.03.42.06l.2-.65c-.14-.03-.33-.03-.46-.03zm-8.62.32a2.19 2.19 0 00-1.25-.32c-.76 0-1.28.39-1.28 1 0 .52.39.8 1.06.9l.32.04c.35.06.55.16.55.32 0 .22-.26.39-.71.39-.45 0-.8-.17-1.02-.33l-.33.52c.36.26.84.39 1.32.39.9 0 1.4-.42 1.4-1 0-.55-.4-.84-1.05-.94l-.32-.03c-.29-.03-.51-.1-.51-.3 0-.22.22-.35.57-.35.39 0 .77.17.97.26l.28-.55zm17.88-.32a.9.9 0 00-.8.45v-.38h-.67v3.1h.67v-1.75c0-.52.22-.8.64-.8.13 0 .29.03.42.06l.19-.65c-.13-.03-.32-.03-.45-.03zm-8.58 1.61c0 .94.64 1.62 1.63 1.62.45 0 .77-.1 1.09-.36l-.32-.55c-.26.2-.51.3-.8.3-.55 0-.93-.4-.93-1 0-.59.38-.97.93-1 .29 0 .54.1.8.28l.32-.54a1.59 1.59 0 00-1.1-.36c-.98 0-1.62.68-1.62 1.61zm6.21 0v-1.54h-.67v.38a1.15 1.15 0 00-.96-.45c-.87 0-1.54.68-1.54 1.61 0 .94.67 1.62 1.54 1.62.45 0 .77-.17.96-.46v.4h.67v-1.56zm-2.47 0c0-.54.36-1 .93-1 .55 0 .93.42.93 1 0 .55-.38 1-.93 1-.57-.03-.93-.45-.93-1zm-8.04-1.6c-.9 0-1.54.64-1.54 1.6 0 .97.64 1.62 1.57 1.62.45 0 .9-.13 1.25-.42l-.32-.49c-.25.2-.57.33-.9.33-.41 0-.83-.2-.92-.75h2.27v-.25c.03-1-.54-1.65-1.4-1.65zm0 .57c.42 0 .7.26.77.74h-1.6c.06-.42.35-.74.83-.74zm16.7 1.03V30.5h-.68v1.61a1.15 1.15 0 00-.96-.45c-.87 0-1.54.68-1.54 1.61 0 .94.67 1.62 1.54 1.62.45 0 .77-.17.96-.46v.4h.67v-1.56zm-2.47 0c0-.54.35-1 .93-1 .54 0 .93.42.93 1 0 .55-.39 1-.93 1-.58-.03-.93-.45-.93-1zm-22.5 0v-1.54h-.67v.38a1.15 1.15 0 00-.96-.45c-.86 0-1.54.68-1.54 1.61 0 .94.68 1.62 1.54 1.62.45 0 .77-.17.96-.46v.4h.68v-1.56zm-2.5 0c0-.54.36-1 .94-1 .54 0 .93.42.93 1 0 .55-.39 1-.93 1-.58-.03-.93-.45-.93-1zm28.42 1.41v.06h.09v-.03-.02h-.09zm.06-.04a.1.1 0 01.06.02c.02.01.03.03.03.05l-.02.05a.09.09 0 01-.06.02l.08.09h-.06l-.07-.09h-.02v.09h-.05v-.23h.1zm-.02.3h.07a.19.19 0 00.11-.18.2.2 0 00-.1-.18.19.19 0 00-.26.18.2.2 0 00.1.17l.08.02zm0-.43a.24.24 0 01.18.07.25.25 0 01.07.17.24.24 0 01-.07.18.24.24 0 01-.17.07.24.24 0 01-.24-.15.24.24 0 01-.01-.1l.01-.1a.25.25 0 01.13-.12.24.24 0 01.1-.02z"></path></g></g></svg>
                        {{-- visa --}}
                        <svg class="me-3" width="60px" height="40px" viewBox="0 0 60 40"><g fill="none" fill-rule="evenodd"><rect fill="#FFFFFE" fill-rule="nonzero" width="60" height="40" rx="4"></rect><g fill="#182E66" fill-rule="nonzero"><path d="M25.823 26h-3.521l2.201-13h3.52l-2.2 13M19.645 13l-3.198 8.941-.378-1.925-1.13-5.845S14.805 13 13.35 13H8.062L8 13.22s1.617.34 3.509 1.486L14.423 26h3.496l5.337-13h-3.61M41.849 22l1.83-5 1.03 5h-2.86ZM49 26l-2.575-13h-3.54c-1.193 0-1.484.969-1.484.969L36.605 26h3.352l.67-1.93h4.09l.376 1.93H49ZM37.103 16.245l.455-2.697S36.154 13 34.69 13c-1.583 0-5.341.71-5.341 4.158 0 3.245 4.41 3.285 4.41 4.988 0 1.704-3.956 1.4-5.261.325l-.475 2.82s1.424.709 3.6.709c2.177 0 5.46-1.156 5.46-4.3 0-3.265-4.45-3.57-4.45-4.989 0-1.42 3.106-1.237 4.47-.466"></path><path d="m15.628 20-1.067-5.832S14.43 13 13.056 13H8.058L8 13.22s2.402.53 4.707 2.516c2.202 1.898 2.92 4.264 2.92 4.264"></path></g><rect stroke="#CBCBCB" x=".5" y=".5" width="59" height="39" rx="3"></rect></g></svg>
                    </div>
                </div>
                <div class="col-3 d-flex justify-content-end align-items-center">
                    <a href="{{ route('home') }}">
                        <h1 class="fw-bold text-primary fs-2 m-0">Larastripe</h1>                    
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>