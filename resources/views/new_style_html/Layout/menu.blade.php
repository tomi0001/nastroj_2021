
    <div class="main-menu">
            <div class="main-menu-position" onclick="LoadPage('{{route('users.main')}}')">
                <a class="  main-menu-menu font-menu" >
                    GŁÓWNA STRONA
                </a>
            </div>
            <div class="main-menu-position ">
                <a class="dropdown-toggle main-menu-menu font-menu" onclick="showMenuSearch()">
                WYSZUKAJ
                </a>
            </div>
            <div class="main-menu-position">
                <a class="dropdown-toggle main-menu-menu font-menu" onclick="showMenuSettings()">
                USTAWIENIA KONTA
                </a>
            </div>
            <div class="main-menu-position"  onclick="LoadPage('{{route('logout')}}')">
                <a class=" main-menu-menu  font-menu" >
                WYLOGUJ
                </a>
            </div>
    </div>

    <div class="main-menu-search">
        <div class="main-menu-search-title">
            <div class="main-menu-search-position-static">
                <span class="  main-menu-search-title font-menu-span" >
                    wyszukaj nastroje
                </span>
            </div>
            <div class="main-menu-search-position">
                <a class="main-menu-search-position font-menu" onclick="LoadPage('{{ route('search.searchMood')}}')">
                    Wyszukaj nastrój
                </a>
            </div>
            <div class="main-menu-search-position">
            <a class="main-menu-search-position font-menu" onclick="LoadPage('{{ route('search.searchSleep')}}')">
                Wyszukaj sen
            </a>
            </div>
            <div class="main-menu-search-position">
            <a class="main-menu-search-position font-menu" onclick="LoadPage('{{ route('search.averageMood')}}')">
                Oblicz średnią trwania nastroju
            </a>
            </div>
            <div class="main-menu-search-position">
            <a class="main-menu-search-position font-menu" onclick="LoadPage('{{ route('search.allDayMoodForm')}}')">
                Wyszukaj akcję całodniową
            </a>
            </div>
            <div class="main-menu-search-position">
            <a class="main-menu-search-position font-menu" onclick="LoadPage('{{ route('settings.addNewAction')}}')">
                Oblicz róznice miedzy końcem snu a porannymi lekami
            </a>
            </div>
            <div class="main-menu-search-position">
            <a class="main-menu-search-position font-menu" onclick="LoadPage('{{ route('search.sumHowMoodForm')}}')">
                Oblicz ile H trwały nastroje
            </a>
            </div>
           
        </div>
        <div class="main-menu-search-title">
            <div class="main-menu-search-br"></div>
            <div class="main-menu-search-position-static">
            <span class="  main-menu-search-title font-menu-span"  >
                wyszukaj produkty
            </span>
            </div>
            <div class="main-menu-search-position">
            <a class="main-menu-search-position font-menu" onclick="LoadPage('{{ route('search.searchDrugs')}}')">
                Wyszukaj produkt
            </a>
            </div>
            <div class="main-menu-search-position">
            <a class="main-menu-search-position font-menu" onclick="LoadPage('{{ route('settings.addNewAction')}}')">
                WYSZUKAJ NASTRÓJ WG PRODUKT
            </a>
            </div>
            
        </div>
        
    </div>


    <div class="main-menu-settings">
        <div class="main-menu-search-title">
            <div class="main-menu-search-position-static">
                <span class="  main-menu-search-title font-menu-span" >
                    ustawienia nastroju
                </span>
            </div>
            <div class="main-menu-search-position">
                <a class="main-menu-search-position font-menu" onclick="LoadPage('{{ route('settings.addNewAction')}}')">
                DODAJ NOWĄ AKCJE 
                </a>
            </div>
            <div class="main-menu-search-position">
            <a class="main-menu-search-position font-menu" onclick="LoadPage('{{ route('settings.levelMood')}}')">
                POZIOMY NASTROJU
            </a>
            </div>
            <div class="main-menu-search-position">
            <a class="main-menu-search-position font-menu"  onclick="LoadPage('{{ route('settings.changeNameAction')}}')">
                ZMIEŃ NAZWY AKCJI
            </a>
            </div>
            <div class="main-menu-search-position">
            <a class="main-menu-search-position font-menu" onclick="LoadPage('{{ route('settings.changeDateAction')}}')">
                ZMIEŃ DATY AKCJI
            </a>
            </div>
            <div class="main-menu-search-position-static" >
            <span class="  main-menu-search-title font-menu-span" >
            USTAWIENIA UŻYTKOWNIKA
            </span>
            </div>
            <div class="main-menu-search-position">
            <a class="main-menu-search-position font-menu" onclick="LoadPage('{{ route('settings.addDoctorNew')}}')">
            LOGOWANIE DOCTORA
            </a>
            </div>
            <div class="main-menu-search-position">
            <a class="main-menu-search-position font-menu"  onclick="LoadPage('{{ route('settings.settingsUserSet')}}')">
            USTAWIENIA UŻYTKOWNIKA
            </a>
            </div>
        </div>
        <div class="main-menu-search-br"></div>
        <div class="main-menu-search-title">
        
            <div class="main-menu-search-position-static">
            <span class="  main-menu-search-title font-menu-span" >
            USTAWIENIA PRODUKTÓW
            </span>
            </div>
            <div class="main-menu-search-position">
            <a class="main-menu-search-position font-menu" onclick="LoadPage('{{ route('settings.addNewGroup')}}')">
            DODAJ NOWĄ GRUPĘ
            </a>
            </div>
            <div class="main-menu-search-position">
            <a class="main-menu-search-position font-menu" onclick="LoadPage('{{ route('settings.addNewSubstance')}}')">
            DODAJ NOWĄ SUBSTANCJĘ
            </a>
            </div>
            <div class="main-menu-search-position">
            <a class="main-menu-search-position font-menu" onclick="LoadPage('{{ route('settings.addNewProduct')}}')">
            DODAJ NOWĄ PRODUKT  
            </a>
            </div>
            <div class="main-menu-search-position">
            <a class="main-menu-search-position font-menu" onclick="LoadPage('{{ route('settings.editGroup')}}')">
                EDYTUJ GRUPĘ
            </a>
            </div>
            <div class="main-menu-search-position">
            <a class="main-menu-search-position font-menu" onclick="LoadPage('{{ route('settings.editSubstance')}}')">
            EDYTUJ SUBSTANCJĘ
            </a>
            </div>
            <div class="main-menu-search-position">
            <a class="main-menu-search-position font-menu" onclick="LoadPage('{{ route('settings.editProduct')}}')">
            EDYTUJ PRODUKT
            </a>
            </div>
            <div class="main-menu-search-position">
            <a class="main-menu-search-position font-menu" onclick="LoadPage('{{ route('settings.planedDose')}}')">
            ZAPLANUJ DAWKĘ
            </a>
            </div>

        </div>
        
        
    </div>
