<?php
/**
 * mise en page de la page d'accueil
 */
// Template de page : header
 include __DIR__ . "/../layout/header_lyt.php";
 ?>
 
 <body>
    <main>
        <!-- elbaorez votre pizza -->
        <section>
            <h2>Elaborer votre pizza</h2>
            <!-- taille -->
            <article>
                <h3>Taille</h3>
                <div><img src="" alt="image d'une pizza"></div>
                <a href="<?php echo BASE_URL . '../App/views/layout/modal_lyt.php?card=TAI'; ?>">Choisir</a>
            </article>
            <!-- pate -->
            <article>
                <h3>Pâte</h3>
                <div><img src="" alt="image d'une pizza"></div>
                <a href="<?php echo BASE_URL . '../App/views/layout/modal_lyt.php?card=PAT'; ?>">Choisir</a>
            <!-- base -->
            </article>
            <article>
                <h3>Base</h3>
                <div><img src="" alt="image d'une pizza"></div>
                <a href="<?php echo BASE_URL . '../App/views/layout/modal_lyt.php?card=BAS'; ?>">Choisir</a>
            </article>
            <!-- ingredients -->
            <article>
                <h3>Ingredients</h3>
                <div><img src="" alt="image d'une pizza"></div>
                <a href="<?php echo BASE_URL . '../App/views/layout/modal_lyt.php?card=ING'; ?>">Choisir</a>
            </article>
        </section>

        <!-- reacapitulons -->
        <section>
            <h2>Récapitulons !</h2>
            <!-- taille -->
            <article>
                <h3>Taille</h3>
                <div><img src="" alt="image d'une pizza"></div>
                <p>Déscription</p>
                <p>Taille</p>
                <p>Prix</p>
                <a href="">Modifier</a>
            </article>
            <!-- pate -->
            <article>
                <h3>Pâte</h3>
                <div><img src="" alt="image d'une pizza"></div>
                <p>Déscription</p>
                <p>Taille</p>
                <p>Prix</p>
                <a href="">Modifier</a>
            <!-- base -->
            </article>
            <article>
                <h3>Base</h3>
                <div><img src="" alt="image d'une pizza"></div>
                <p>Déscription</p>
                <p>Taille</p>
                <p>Prix</p>
                <a href="">Modifier</a>
            </article>
            <!-- ingredients -->
            <article>
                <h3>Ingredients</h3>
                <div><img src="" alt="image d'une pizza"></div>
                <p>Déscription</p>
                <p>Taille</p>
                <p>Prix</p>
                <a href="">Modifier</a>
            </article>
        </section>

        <!-- commander -->
        <section>
            <h2>Commander</h2>
            <p>Tarificaton</p>
            <p>Prix total</p>
            <a href="">Commander</a>
        </section>
    </main>
 </body>


<?php
// Template de page : footer
 include __DIR__ . "/../layout/footer_lyt.php";
 ?>