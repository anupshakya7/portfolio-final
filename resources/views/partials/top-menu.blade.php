<nav id="desktop-nav">
    <div class="logo">
        Anup Shakya
    </div>
    <div>
        {{menu('top-menu','partials.menu-items.top-menu-items-desktop')}}
    </div>
</nav>
<nav id="hamburger-nav">
    <div class="logo">
        Anup Shakya
    </div>
    <div class="hamburger-menu">
        <div class="hamburger-icon" onclick="toggleMenu('parent')">
            <span></span>
            <span></span>
            <span></span>
        </div>
        {{menu('top-menu','partials.menu-items.top-menu-items-mobile')}}
        {{-- <div class="menu-links">
            <li><a href="#about" onclick="toggleMenu()">About</a></li>
            <li><a href="#experience" onclick="toggleMenu()">Experience</a></li>
            <li><a href="#projects" onclick="toggleMenu()">Projects</a></li>
            <li><a href="#contact" onclick="toggleMenu() ">Contact</a></li>
        </div> --}}
    </div>
</nav>