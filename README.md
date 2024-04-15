<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
</head>
<body>
<article>
    <header>
        <h1>
            UnX (Unemployment Explorer)
        </h1>
    </header>
    <h2>Cuprins</h2>
    <ul>
        <li>
            <a href="#authors">Autori</a>
        </li>
        <li>
            <a href="#introduction">1. Introducere</a>
            <ul>
                <li><a href="#introduction-purpose">1.1 Scop</a></li>
                <li><a href="#conventions">1.2 Convenție de scriere</a></li>
                <li><a href="#audience">1.3 Publicul țintă</a></li>
                <li><a href="#product-scope">1.4 Scopul produsului</a></li>
                <li><a href="#references">1.5 Referințe</a></li>
            </ul>
        </li>
        <li><a href="#overall">2. Descriere Generală</a>
            <ul>
                <li><a href="#product-perspective">2.1 Perspectiva produsului</a></li>
                <li><a href="#product-functions">2.2 Funcțiile produsului</a></li>
                <li><a href="#users">2.3 Clase și caracteristici ale utilizatorilor</a></li>
                <li><a href="#operating-environment">2.4 Mediul de operare</a></li>
                <li><a href="#documentation">2.5 Documentația pentru utilizator</a></li>
            </ul>
        </li>
        <li><a href="#external">3. Interfețele aplicației </a>
            <ul>
                <li><a href="#user-interface">3.1 Interfața utilizatorului </a>
                    <ul>
                        <li><a href="#nav-bar">3.1.1 Bara de navigație </a></li>
                        <li><a href="#login-page">3.1.2 Pagina de autentificare </a></li>
                        <li><a href="#signup-page">3.1.3 Pagina de înregistrare </a></li>
                        <li><a href="#sendMail-page">3.1.4 Pagina de trimitere email pentru resetarea parolei</a></li>
                        <li><a href="#resetPassword-page">3.1.5 Pagina de resetarea parolei</a></li>
                        <li><a href="#home-page">3.1.6 Pagina de acasă </a></li>
                        <li><a href="#learning">3.1.7 Pagina de învățare</a></li>
                        <li><a href="#rules">3.1.8 Pagina cu legislația</a></li>
                        <li><a href="#signs">3.1.9 Pagina cu semnele de circulație</a></li>
                        <li><a href="#tests">3.1.10 Pagina Pagina de chestionare </a></li>
                        <li><a href="#about">3.1.11 Pagina informativa </a></li>
                        <li><a href="#help">3.1.12 Pagina de ajutor </a></li>
                        <li><a href="#profile">3.1.13 Pagina de profil </a></li>
                        <li><a href="#error400">3.1.14 Pagina 400 </a></li>
                        <li><a href="#error404">3.1.15 Pagina 404 </a></li>
                        <li><a href="#admin">3.1.16 Pagina administratorului </a></li>
                        <li><a href="#changepass">3.1.17 Pagina de schimbare a parolei </a></li>
                    </ul>
                </li>
                <li><a href="#hardware-interface">3.2 Interfața Hardware </a></li>
                <li><a href="#software-interface">3.3 Interfața Software</a></li>
                <li><a href="#communication-interface">3.4 Interfața de comunicare</a></li>
            </ul>
        </li>
        <li><a href="#system-features">4. Caracteristici ale sistemului</a>
            <ul>
                <li><a href="#management">4.1 Gestionarea contului </a>
                    <ul>
                        <li><a href="#management-1">4.1.1 Descriere și generalități </a></li>
                        <li><a href="#management-2">4.1.2 Actualizarea informațiilor</a></li>
                        <li><a href="#management-3">4.1.3 Condiții de funcționare</a></li>
                    </ul>
                </li>
                <li><a href="#utilizatori">4.2 Secțiunea Utilizatori</a>
                    <ul>
                        <li><a href="#utilizatori-1">4.2.1 Descriere și generalități</a></li>
                        <li><a href="#utilizatori-2">4.2.2 Actualizarea informațiilor</a></li>
                        <li><a href="#utilizatori-3">4.2.3 Condiții de funcționare</a></li>
                    </ul>
                </li>
                <li><a href="#administrator">4.3 Secțiunea Admin</a>
                    <ul>
                        <li><a href="#administrator-1">4.3.1 Descriere și generalități</a></li>
                        <li><a href="#administrator-2">4.3.2 Actualizarea informațiilor</a></li>
                        <li><a href="#administrator-3">4.3.3 Condiții de funcționare</a></li>
                    </ul>
                </li>
                <li><a href="#logout">4.4 Secțiunea Logout</a>
                    <ul>
                        <li><a href="#logout-1">4.4.1 Descriere și generalități</a></li>
                        <li><a href="#logout-2">4.4.2 Actualizarea informațiilor</a></li>
                        <li><a href="#logout-3">4.4.3 Condiții de funcționare</a></li>
                    </ul>
                </li>
                <li><a href="#other">4.5 Alte funcționalități </a>
                    <ul>
                        <li><a href="#other-1">4.5.1 Descriere și generalități</a></li>
                        <li><a href="#other-2">4.5.2 Actualizarea informațiilor</a></li>
                        <li><a href="#other-3">4.5.3 Condiții de funcționare</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li><a href="#non-functional">5.Funcționalități pentru protecție și securitate</a>
            <ul>
                <li><a href="#safety">5.1 Protecția datelor</a></li>
                <li><a href="#security">5.2 Securizarea datelor</a></li>
                <li><a href="#software-attributes">5.3 Calitățile Software </a></li>
            </ul>
        </li>
    </ul>
    <div role="contentinfo">
        <section id="authors" typeof="sa:AuthorsList">
            <h2>Autori</h2>
            <ul>
                <li property="schema:author" typeof="sa:ContributorRole">
            <span typeof="schema:Person">
              <meta content="Laura" property="schema:givenName">
              <meta content="Florina" property="schema:additionalName">
              <meta content="Chiriac" property="schema:familyName">
              <span property="schema:name">Chiriac Laura-Florina</span>
            </span>
                    <ul>
                        <li property="schema:roleContactPoint" typeof="schema:ContactPoint">
                            <a href="mailto:aprofireiadrianmihai1@gmail.com" property="schema:email">laurachiriac.cl@gmail.com</a>
                        </li>
                    </ul>
                </li>
                <li property="schema:author" typeof="sa:ContributorRole">
            <span typeof="schema:Person">
              <meta content="Sebastian" property="schema:givenName">
              <meta content="Stanciu" property="schema:familyName">
              <span property="schema:name">Stanciu Sebastian</span>
            </span>
                    <ul>
                        <li property="schema:roleContactPoint" typeof="schema:ContactPoint">
                            <a href="mailto:tudor.stefan.paulet@gmail.com" property="schema:email">sebastian.stanciu.20@gmail.com</a>
                        </li>
                    </ul>
            </ul>
        </section>
    </div>
    <section id="introduction">
        <h3>1. Introducere</h3>
        <section id="introduction-purpose">
            <h4>1.1 Scop</h4>
            <p>
                UnX (Unemployment Explorer) este o aplicație web dezvoltată de studenții menționați în secțiunea
                de Autori de la Facultatea de
                Informatică a Universității Alexandru Ioan Cuza.
                Scopul acestui document este acela de a prezenta o descriere detaliată a funcționalităților, precum și
                de a specifica cerințele aplicației web. Această aplicație va oferi utilizatorilor posibilitatea vizualizării prin diferite metode și în mai multe formate a unor infografice ce prezintă date statistice despre șomajul din România, dar și metode de comparare mai facilă a datelor.
            </p>
        </section>
        <section id="conventions">
            <h4> 1.2 Convenția documentului</h4>
            <ul>
                <li>
                    Acest document urmează șablonul de documentație a cerințelor software conform IEEE Software
                    Requirements
                    Specification.
                </li>
                <li>
                    Textul <b>îngroșat</b> este folosit pentru a defini noțiuni personalizate sau pentru a accentua
                    concepte
                    importante.
                </li>
            </ul>
        </section>
        <section id="audience">
            <h4>1.3 Publicul țintă</h4>
            <p>
                Acest document este destinat profesorilor, studenților sau dezvoltatorilor, însă orice utilizator,
                indiferent
                de cunoștințele lor tehnologice,
                poate consulta secțiunile de <b>Interfeța utilizatorului</b> și <b>Caracteristici ale sistemului</b>
                pentru a
                obține o mai bună înțelegere a ceea ce oferă aplicația.
            </p>
        </section>
        <section id="product-scope">
            <h4>1.4 Scopul Produsului</h4>
            <p>
                Scopul aplicației este acela de a oferi utilizatorilor date exacte și corecte despre șomajul din România, dar și de a oferi metode de vizualizare moderne a acestor date statistice. Utilizatorii doritori să afle anumite informații și să primească date exacte și actualizate constant despre piața muncii din România se pot bucura de o multitudine de funcționalități care i-ar putea ajuta să descopere datele de care au nevoie dar și să aibă un outlook asupra influențelor sociale din sfera muncii. De asemenea, utilizatorii își pot crea un cont
                pentru a
                beneficia de restul funcționalităților UNX Romania, în special de cea de "Community Reports".
            </p>
        </section>
        <section id="references">
            <h4>1.5 Bibliografie</h4>
            <ul>
                <li>Buraga Sabin-Corneliu, Site-ul Tehnologii Web, FII UAIC</li>
                <li>H Rick. IEEE-Template - GitHub</li>
            </ul>
        </section>
    </section>
    <section id="overall">
        <h3>2. Descriere Generală</h3>
        <section id="product-perspective">
            <h4>2.1 Perspectiva produsului</h4>
            <p>UNX Romania este o aplicație dezvoltată în cadrul cursului de Tehnologii Web,
                menită să ofere informații relevante despre șomajul din România și despre tendințele din această sferă.
        </section>
        <section id="product-functions">
            <h4>2.2 Funcționalitățile produsului</h4>
            Fiecare utilizator va avea acces la urmatoarele funcționălități:
            <ul>
                <li>să se înregistreze pe site.</li>
                <li>să se autentifice pe site.</li>
                <li>să își reseteze parola in cazul in care a uitat-o.</li>
                <li>să consulte pagina "Acasă" și noutățile disponibile</li>
                <li>să acceseze pagina "Unemployment Data" pentru a accesa toate datele relevante de pe site</li>
                <li> să acceseze paginile de "About" si "Contact" pentru a avea o mai bună perspectivă asupra surselor de informare folosite de site</li>
                <li>să acceseze paginile "Gender Reports" și "Age Reports" pentru a vizualiza datele statistice în funcție de gen și vârstă</li>
                <li>să acceseze pagina "All Collected Data" pentru a vedea toate datele de care ar putea avea nevoie mai ușor</li>
                <li>să acceseze pagina "Time Tracker" pentu a vedea un grafic interactiv în legătură cu șomajul din România și evoluția datelor în timp </li>
                <li>dacă este <b>autentificat</b>, să acceseze pagina "Community Reports" dacă vrea să facă o actualizare a datelor și să ofere informații actualizate și celorlalți utilizatori</li>
                <li>dacă este <b>autentificat</b>, să își acceseze profilul și sa verifice statisticile personale</li>
                <li>dacă utilizatorul are rol de <b>admin</b>, acesta poate șterge utilizatori din baza de date</li>
                <li>dacă utilizatorul are rol de <b>admin</b>, acesta poate aproba report-uri noi</li>
                <li>dacă utilizatorul are rol de <b>admin</b>, acesta poate modifica și actualiza informații de pe site, resurse, sau poate șterge informații eronate de pe site</li>
            </ul>
        </section>
        <section id="users">
            <h4>2.3 Clase și caracteristici ale utilizatorilor</h4>
            <h5>2.3.1 Utilizator principal</h5>
            <ul>
                <li>utilizatorii autentificați pot fi:</li>
                <li style="list-style: none">
                    <ul>
                        <li>orice categorie de oameni care doresc să vizualizeze informații mai detaliate și să facă anumite report-uri pentru a ajuta la actualizarea datelor</li>
                        </li>
                    </ul>
                </li>
                <li>
                    utilizatorii neautentificați pot fi:
                    <ul>
                        <li> orice categorie de oameni care doresc să acceseze câteva date de pe site despre șomaj</li>
                        </li>
                    </ul>
                </li>
            </ul>
            <h5>2.3.2 Caracteristici</h5>
            <ul>
                <li>Utilizatorii care sunt <b> autentificați </b> pot accesa pagină de "Acasă", "Time Tracker", "Unemployment Data", ș.a.m.d., dar cel mai important, pot accesa pagina de "Community Reports" pentru a oferi informații actualizate și pentru a face report-uri noi.</li>
                </li>
                <li>Utilizatorii care nu sunt autentificați pot să vizualizeze și ei datele despre șomaj de pe site, dar diferența principală este că nu au dreptul să contribuie.
                Așadar, aceștia pot să se înregistreze ca și utilizator și să beneficieze de toate
                funcționalitățile, inclusiv cea de a face report-uri noi și de a contesta informații deja apărute pe site.</li>
                </li>
            </ul>
        </section>
        <section id="operating-environment">
            <h4>2.4 Mediul de operare</h4>
            <p>
                Produsul dezvoltat poate fi utilizat pe orice dispozitiv cu un browser web care suportă HTML5, CSS și JavaScript.
            </p>
        </section>
        <section id="documentation">
            <h4>2.5 Documentația pentru utilizator</h4>
            <p>
                Utilizatorii pot consulta acest document pentru explicații detaliate despre funcționalitățile aplicației
                web.
            </p>
        </section>
    </section>
    <section id="external">
        <h3>3. Interfețele aplicației</h3>
        <section id="user-interface">
            <h4>3.1 Interfața utilizatorului</h4>
            Mai jos, puteți vedea o prezentare generală a fiecărei pagini a aplicației și funcționalităților pe care le
            oferă:
            <ul>
                <li id="nav-bar"><b>Bara de navigație</b></li>
                <li style="list-style: none">
                    <ul>
                        <li>Aceasta reprezintă meniul de navigare către fiecare pagina a aplicației, prezent pe fiecare
                            pagină totodată.
                        </li>
                        <li class="pictures" style="list-style: none"><img alt="login" src="images/navBar.png" width=800
                        ></li>
                    </ul>
                </li>
                <li id="login-page"><b>Pagina de autentificare</b></li>
                <li style="list-style: none">
                    <ul>
                        <li>Pagina are rolul de a realiza autentificarea utilizatorilor la RoT.</li>
                        <li>Pentru a se autentifica, utilizatorul trebuie să completeze câmpurile de "username" și
                            "parolă" cu
                            credențiale <b>valide</b>, urmând să acționeze butonul <b>Autentificare</b>.
                        </li>
                        <li> În cazul în care utilizatorul nu are cont pe site, acesta își poate crea unul prin
                            accesarea pagini de
                            înregistrare, ce se face prin apăsarea butonului <b>Creează un cont nou</b>.
                        </li>
                        <li> În cazul în care utilizatorul și-a uitat parola, acesta poate să o reseteze selectând
                            opțiunea de
                            <b> Ai uitat parola? </b></li>
                        <li class="pictures" style="list-style: none"><img alt="login" height="400"
                                                                           src="images/loginPage.png" width=800>
                        </li>
                    </ul>
                </li>
                <li id="signup-page"><b>Pagina de înregistrare</b></li>
                <li style="list-style: none">
                    <ul>
                        <li>Pagina oferă funcționalitatea de înregistrare a utilizatorilor, pentru a putea beneficia de
                            toate
                            funcționalitățile RoT.
                        </li>
                        <li>Pentru a se înregistra, utilizatorul trebuie să completeze câmpurile <b>Email</b>,
                            <b>Nume</b>,
                            <b>Prenume</b>, <b>Nume utilizator</b> și <b>Parola</b>. Mai mult, câmpurile <b>Email</b> și
                            <b>Nume utilizator</b>
                            trebuie să fie <b>unice</b>.
                        </li>
                        <li>În cazul în care utilizatorul își amintește că are un cont existent, acesta poate apasă
                            butonul
                            <b>Autentificare</b> aflat în partea de jos a formularului, sau pe butonul <b>Login</b> din
                            coltul din dreapta-sus
                            al paginii, pentru a reveni la meniul de autentificare.
                        </li>
                        <li class="pictures" style="list-style: none"><img alt="signup" height="400"
                                                                           src="images/signupPage.png" width=800>
                    </ul>
                </li>
                <li id="sendMail-page"><b>Pagina de de resetare a parolei prin mail</b></li>
                <li style="list-style: none">
                    <ul>
                        <li> Pagina are rolul de a trimite un email către utilizator, care îl va redirecționa spre o
                            pagină nouă, unde care
                            își va introduce nouă parolă. La apăsarea butonului de <b> Trimite mail </b>, utilizatorul
                            va fi redirecționat
                            către pagină de autentificare.
                        </li>
                        <li class="pictures" style="list-style: none"><img alt="login" height="400"
                                                                           src="images/sendMail.png" width=800></li>
                    </ul>
                </li>
                <li id="home-page"><b> Pagina de acasă</b></li>
                <li style="list-style: none">
                    <ul>
                        <li>Pagina are rolul de prezența ultimele noutăți, sfaturi și clasementele actualizate.</li>
                        <li class="pictures" style="list-style: none"><img alt="overview" src="images/homePage.png"
                                                                           width=800>
                        </li>
                    </ul>
                </li>
                <li id="learning"><b>Pagina de învățare</b></li>
                <li style="list-style: none">
                    <ul>
                        <li>Pagina oferă o întrebare dată spre rezolvare, la care se va oferi o explicație indiferent de
                            corectitudinea
                            răspunsului dat de utilizator. Butonul <b>Trimite răspunsul</b> va valida întrebarea, iar
                            <b>Următoarea întrebare</b>
                            o va sări pe cea curentă, dar se va reveni mai târziu la ea.
                        </li>
                        <li class="pictures" style="list-style: none"><img alt="overview" src="images/learn1.png"
                                                                           width=800>
                        </li>
                        <li>După ce răspunsul a fost trimis, utilizatorul va vedea corectitudinea fiecărui răspuns,
                            însoțite de o
                            explicație corespunzătoare.
                        </li>
                        <li class="pictures" style="list-style: none"><img alt="overview" src="images/learn2.png"
                                                                           width=800>
                        </li>
                        <li class="pictures" style="list-style: none"><img alt="editprofile"
                                                                           src="images/learningPage.png" width=800>
                        </li>
                    </ul>
                </li>
                <li id="rules"><b>Pagina cu legislația</b></li>
                <li style="list-style: none">
                    <ul>
                        <li>Pagina conține codul rutier actualizat la zi.</li>
                        <li class="pictures" style="list-style: none"><img alt="overview" src="i mages/rulesPage.png"
                                                                           width=800>
                        </li>
                    </ul>
                <li id="signs"><b>Pagina cu semnele de circulație</b></li>
                <li style="list-style: none">
                    <ul>
                        <li>Pagina conține semne rutiere atât din țară noastră, cât și din alte cinci țări.</li>
                        <li> Pentru a accesa semnele din România, se va face click pe steag, urmând să se selecteze în
                            mod specific
                            categoria de semne dorită spre a fi văzută. Apăsând pe oricare dintre cele 5 steaguri
                            străine, se va deschide
                            o listă cu semnele de circulație corespunzătoare.
                        </li>
                        <li class="pictures" style="list-style: none"><img alt="streetSigns"
                                                                           src="images/streetSigns.png" width=800
                        ></li>
                        <li class="pictures" style="list-style: none"><img alt="streetSignsRomania"
                                                                           src="images/streetSignsRomania.png" width=800
                        ></li>
                        <li class="pictures" style="list-style: none"><img alt="streetSignsRomaniaExamples"
                                                                           src="images/streetSignsRomaniaExample.png" width=800
                        ></li>
                        <li class="pictures" style="list-style: none"><img alt="streetSignsItaly"
                                                                           src="images/streetSignsItaly.png" width=800
                        ></li>
                    </ul>
                </li>
                <li id="tests"><b>Pagina de chestionare</b></li>
                <li style="list-style: none">
                    <ul>
                        <li>Pagina prezintă o lista de chestionare predefinite, la care se poate obține un punctaj maxim
                            de 26 de răspunsuri
                            corecte. Astfel, fiecare dintre chestionare are un status: <b>Eșuat</b>, <b>Neîncercat</b>
                            și <b>Perfect</b>;
                            acestea pot fi refăcute până la obținerea punctajului maxim.
                        </li>
                        <li>La momentul începerii unui chestionar, un cronometru de 30 de minute va porni, acesta
                            constituind durata de
                            rezolvare a testului. Testul va fi trecut dacă utilizatorul va răspunde la cel puțin 22 de
                            întrebări corect,
                            dar totodată nu se va opri dacă acesta acumulează mai mult de 4 răspunsuri greșite.
                        </li>
                        <li>Întrebările au 3 variante de răspuns, cu cel puțin unul corect la fiecare. Pentru a rezolva,
                            se va(vor) bifa
                            răspunsul(urile) corect(e) și se va apăsa butonul <b>Trimite răspunsul</b>, sau <b>Răspunde
                                mai târziu</b>,
                            dacă se dorește amânarea pe mai târziu a întrebării curente.
                        </li>
                        <li>La finalul completării testului, acesta își va schimbă statusul, dacă este cazul, și se va
                            primi un mesaj
                            conform căruia utilizatorul a trecut sau nu testul cu brio.
                        </li>
                        <li class="pictures" style="list-style: none"><img alt="streetSignsRomania"
                                                                           src="images/testList.png" width=800
                        ></li>
                        <li class="pictures" style="list-style: none"><img alt="streetSignsRomaniaExamples"
                                                                           src="images/testExample.png" width=800
                        ></li>
                        <li class="pictures" style="list-style: none"><img alt="streetSignsItaly"
                                                                           src="images/testDone.png" width=800
                        ></li>
                    </ul>
                </li>
                <li id="about"><b>Pagina informativa</b></li>
                <li style="list-style: none">
                    <ul>
                        <li>Pagina are rolul de a introduce site-ul RoT pe scurt, prin menționarea unor mici detalii:
                            tehnologii
                            utilizate, numele autorilor, scopul aplicației și bibliografia.
                        </li>
                        <li class="pictures" style="list-style: none"><img alt="overview" src="images/aboutPage.png" width=800>
                        </li>
                    </ul>
                <li id="help"><b>Pagina de ajutor</b></li>
                <li style="list-style: none">
                    <ul>
                        <li>Pagina are rolul de a prezenta câteva sfaturi pentru a putea beneficia de o experienta
                            completa pe site.
                        </li>
                        <li class="pictures" style="list-style: none"><img alt="overview" src="images/helpPage.png"
                                                                           width=800
                        </li>
                    </ul>
                <li id="profile"><b>Pagina de profil</b></li>
                <li style="list-style: none">
                    <ul>
                        <li>Pagina prezintă informații despre utilizator.</li>
                        <li>
                            <img alt="overview" src="images/profile1.png" width=800>
                        </li>
                        <li>Utilizatorul <b>autentificat</b> își va vedea la profil detalii despre cont, un procent
                            referitor la
                            progresul sau, numărul de întrebări/chestionare parcurse (corecte și greșite), dar și câteva
                            grafice
                            corespunzătoare acestora.
                        </li>
                        <li>Mai mult, utilizatorul va avea la dispoziție un buton <b>Logout</b> prin care poate ieși din
                            cont,
                            dar is unul <b>Schimbă parolă</b>, în cazul în care își dorește acest lucru.
                        </li>
                        <li><img alt="overview" src="images/profile2.png" width=800></li>
                        <li><img alt="overview" src="images/profile3.png" width=800></li>
                        <li><img alt="overview" src="images/profile4.png" width=800></li>
                    </ul>
                </li>
                <li id="error400"><b>Pagina 400</b></li>
                <li style="list-style: none">
                    <ul>
                        <li>Pagina afișează eroarea <b>400 Cerere greșită</b>.</li>
                        <li class="pictures" style="list-style: none"><img alt="overview" src="images/error400.png"
                                                                           width=800>
                        </li>
                    </ul>
                </li>
                <li id="error404"><b>Pagina 404</b></li>
                <li style="list-style: none">
                    <ul>
                        <li>Pagina afișează eroarea <b>404 Cerere greșită</b>.</li>
                        <li class="pictures" style="list-style: none"><img alt="overview" src="images/error404.png"
                                                                           width=800>
                        </li>
                    </ul>
                </li>
                <li id="admin"><b>Pagina Administratorului</b></li>
                <li style="list-style: none">
                    <ul>
                        <li>Pagina afișează interfață pentru <b>adminstrator</b>.</li>
                        <li class="pictures" style="list-style: none"><img alt="overview" src="images/admin1.png"
                                                                           width=800>
                        </li>
                        <li>Administratorul are capacitatea de a adaugă/modifică
                            întrebări și/sau chestionare și de a șterge utilizatori din baza de date.
                        </li>
                        <li class="pictures" style="list-style: none"><img alt="overview" src="images/admin2.png"
                                                                           width=800>
                        </li>
                        <li>Formularul <b>Creare întrebare</b> se va completa cu informațiile necesare, întrebarea
                            urmand sa se
                            salveze in baza de date. La fel se procedeaza si pentru chestionare.
                        </li>
                        <li class="pictures" style="list-style: none"><img alt="overview" src="images/admin3.png"
                                                                           width=800>
                        </li>
                        <li>Formularul <b>Actualizare întrebare</b> se va completa cu <b>ID-ul</b> dorit, întrebarea
                            urmand sa se
                            salveze in baza de date printr-un formular ca la punctul precedent. La fel se procedeaza si
                            pentru chestionare.
                        </li>
                        <li class="pictures" style="list-style: none"><img alt="overview" src="images/admin4.png"
                                                                           width=800>
                        </li>
                        <li>Pentru a șterge un utilizator din baza de date, se va apasă butonul corespunzător fiecărui
                            utilizator din tabel.
                        </li>
                        <li class="pictures" style="list-style: none"><img alt="overview" src="images/admin5.png"
                                                                           width=800>
                        </li>
                    </ul>
                </li>
                <li id="changepass"><b>Pagina de schimbare a parolei</b></li>
                <li style="list-style: none">
                    <ul>
                        <li>Pagină afișează un formular numit <b>Resetare parolă</b>, unde se vor completa corespunzător
                            câmpurile
                            pentru a schimbă parolă veche cu cea nouă.
                        </li>
                        <li class="pictures" style="list-style: none"><img alt="overview" src="images/changePass.png"
                                                                           width=800>
                        </li>
                        <li>Se va primi un mesaj ce confirmă această schimbare, putând reveni la profil prin acționarea
                            butonului
                            <b>Înapoi la profil</b>.
                        </li>
                        <li class="pictures" style="list-style: none"><img alt="overview" src="images/passChanged.png"
                                                                           width=800>
                        </li>
                    </ul>
                </li>
            </ul>
            <section id="hardware-interface">
                <h4>3.2 Interfața Hardware</h4>
                <p>
                    Acest produs nu necesită interfețe hardware, funcționând pe orice platformă (calculatoare,
                    laptopuri,
                    telefoane etc.), care are instalată un browser.
                </p>
            </section>
            <section id="software-interface">
                <h4>3.3 Interfața Software</h4>
                <p>
                    Cerințele minime de software includ un browser funcțional, compatibil cu HTML5 și cu JavaScript.
                <h5>Postgres Database</h5>
                Aceasta reprezintă baza de date în care stocăm informații despre fiecare utilizator, intrebarile,
                chestionarele si
                raspunsurile la acestea.
            </section>
            <section id="communication-interface">
                <h4>3.4 Interfața de comunicare</h4>
                <p>
                    Aplicația necesită o conexiune la internet. Standardul de comunicare care va fi utilizat este HTTP.
                </p>
            </section>
            <section id="system-features">
                <h3>4. Caracteristici ale sistemului</h3>
                <section id="management">
                    <h4>4.1 Gestionarea contului</h4>
                    <h5 id="management-1">4.1.1 Descriere și generalități</h5>
                    Un utilizator se poate înregistra alegându-și un nume de utilizator, un email, o parola, numele si
                    prenumele.
                    Acesta se poate
                    autentifica având nevoie doar de numele de utilizator și de parolă.
                    <h5 id="management-2">4.1.2 Actualizarea informațiilor</h5>
                    <ul>
                        <li>
                            În momentul în care un utilizator nou este creat, credențialele acestuia sunt introduse în
                            baza de
                            date. De asemenea, când utilizatorul decide să-și modifice credențialele, noile valori sunt
                            și ele
                            actualizate în baza de date.
                        </li>
                    </ul>
                    <h5 id="management-3">4.1.3 Condiții de funcționare</h5>
                    <ul>
                        <li>
                            Pentru a-și modifica credențialele utilizatorul, trebuie să fie autentificat.
                        </li>
                        <li>
                            Pentru a se autentifica, utilizatorul are nevoie de un cont care este înregistrat în baza de
                            date.
                        </li>
                    </ul>
                </section>
                <section id="utilizatori">
                    <h4>4.2 Secțiunea de utilizatori</h4>
                    <h5 id="utilizatori-1">4.2.1 Descriere și generalități</h5>
                    Secțiunea <b>Utilizatori</b> este destinată
                    <b>adminului</b>, și aceasta îi oferă posibilitatea
                    de a vizualiza o listă cu toți utilizatorii din
                    baza de date. De asemenea, acesta are posibilitatea
                    de a elimina utilizatori din baza de date, dacă
                    dorește acest lucru.
                    <h5 id="utilizatori-2">4.2.2 Actualizarea informațiilor</h5>
                    <ul>
                        <li>
                            La apăsarea butonului de ștergere din dreptul fiecărui utilizator, credențialele
                            utilizatorului care a
                            fost selectat, sunt șterse din baza de date.
                        </li>
                    </ul>
                    <h5 id="utilizatori-3">4.2.3 Condiții de funcționare</h5>
                    <ul>
                        <li>
                            Utilizatorul trebuie să fie autentificat.
                        </li>
                        <li>
                            Utilizatorul trebuie să dețină drepturi de admin.
                        </li>
                    </ul>
                </section>
                <section id="administrator">
                    <h4>4.3 Secțiunea Admin</h4>
                    <h5 id="administrator-1">4.3.1 Descriere și generalități</h5>
                    Secțiunea <b>Admin</b> este destinată utilizatorilor ce au drepturi de <b>administrator</b> și
                    această
                    oferă facilități pe care un utilizator normal nu le are. În momentul în care adminul accesează
                    panoul de control,
                    va putea adaugă/modifică întrebări și chestionare direct de pe platforma. Totodată, acesta este
                    capabil să șteargă
                    conturi ale utilizatorilor.
                    <h5 id="administrator-2">4.3.2 Actualizare informațiilor</h5>
                    <ul>
                        <li>
                            În momentul în care adminul adaugă o întrebare sau un chestionar, informațiile despre
                            acestea sunt inserate
                            în baza de
                            date.
                        </li>
                        <li>
                            În momentul în care adminul modifica o întrebare sau un chestionar, informațiile despre
                            acestea sunt
                            actualizate în baza de
                            date.
                        </li>
                    </ul>
                    <h5 id="administrator-3">4.3.3 Condiții de funcționare</h5>
                    <ul>
                        <li>
                            Utilizatorul trebuie să fie autentificat.
                        </li>
                        <li>
                            Utilizatorul trebuie să dețină drepturi de admin.
                        </li>
                    </ul>
                </section>
                <section id="logout">
                    <h4>4.4 Secțiunea de Logout</h4>
                    <h5 id="logout-1">4.4.1 Descriere și generalități</h5>
                    Secțiunea de <b>Logout</b> are rolul de a deconecta utilizatorul de pe cont și îl redirecționează
                    către
                    pagina acasă.
                    <h5 id="logout-2">4.4.2 Actualizare informațiilor</h5>
                    <ul>
                        <li>
                            Tokenul de autentificare este eliminat, prin intermediul JWT.
                        </li>
                    </ul>
                    <h5 id="logout-3">4.4.3 Condiții de funcționare</h5>
                    <ul>
                        <li>
                            Utilizatorul trebuie să fie autentificat.
                        </li>
                    </ul>
                </section>
                <section id="other">
                    <h4>4.5 Alte funcționalități</h4>
                    <h5 id="other-1">4.6.1 Descriere și generalități</h5>
                    In cadrul feed-ului RSS, pot fi văzute doua clasamente ce tin evidenta celor mai harnici utilizatori
                    de pe site.
                    <h5 id="other-2">4.5.2 Actualizarea informațiilor</h5>
                    <ol>
                        <li>
                            Datele care sunt folosite in fluxul RSS sunt extrase pe baza unui camp actualizat permanent
                            din baza de date.
                        </li>
                    </ol>
                    <h5 id="other-3">4.5.3 Cerințe de funcționare</h5>
                    <ul>
                        <li>
                            Utilizatorul trebuie să fie autentificat.
                        </li>
                    </ul>
                </section>
            </section>
            <section id="non-functional">
                <h3>5. Funcționalități pentru protecție și securitate</h3>
                <section id="safety">
                    <h4>5.1 Protecția datelor</h4>
                    <p>
                        Aplicația va asigura confidențialitatea datelor prin intermediul unei criptări.
                    </p>
                </section>
                <section id="security">
                    <h4>5.2 Securizarea datelor</h4>
                    <p>
                        Autorizarea utilizatorilor se face pe baza standardului JWT. Utilizatorii au acces doar la
                        informații legate
                        de progresul in cadrul site-ului, celelalte informații fiind ascunse. Token-ul folosit pentru
                        autorizare este
                        stocat intr-un cookie de tip HTTP-only, lucru care previne atacurile de tip XSS. Mai mult, toate
                        datele sunt introduse
                        in baza de date prin intermediul unor <b>prepared statements</b>, care asigura prevenirea SQL
                        Injection.
                    </p>
                </section>
                <section id="software-attributes">
                    <h4>5.3 Calitățile Software</h4>
                    <ul>
                        <li>Adaptabilitate</li>
                        <li>Ușurință în utilizare</li>
                        <li>Flexibilitate</li>
                    </ul>
                </section>
            </section>
        </section>
    </section>
</article>
</body>
</html>
