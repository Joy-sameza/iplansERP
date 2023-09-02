<main class="main corrier">
      <div class="entrant">
        <h2>Courrier Entrant</h2>
        <section>
          <button>Nbre total de Courrier : <strong>2</strong></button>
          <button>Aujourd'hui : <strong>0</strong></button>
          <button>Ancien Courrier : <strong>0</strong></button>
          <button>Traités/Archivées : <strong>0</strong></button>
        </section>
        <section>
          <h4>Niveau d'importance</h4>
          <span><strong>Exceptionel</strong><strong>0</strong></span>
          <span><strong>Très haute</strong><strong>2</strong></span>
          <span><strong>haute</strong><strong>1</strong></span>
          <span><strong>moyenne</strong><strong>0</strong></span>
          <span><strong>Basse</strong><strong>0</strong></span>
        </section>
        <button class="btn" data-newcourrier>Nouveau courrier</button>
      </div>
      <div class="sortant">
        <h2>Courrier Sortant</h2>
        <section>
          <button>Nbre total de Courrier : <strong>2</strong></button>
          <button>Aujourd'hui : <strong>0</strong></button>
          <button>Ancien Courrier : <strong>0</strong></button>
          <button>Traités/Archivées : <strong>0</strong></button>
        </section>
        <section>
          <h4>Niveau d'importance</h4>
          <span><strong>Exceptionel</strong><strong>0</strong></span>
          <span><strong>Très haute</strong><strong>2</strong></span>
          <span><strong>haute</strong><strong>1</strong></span>
          <span><strong>moyenne</strong><strong>0</strong></span>
          <span><strong>Basse</strong><strong>0</strong></span>
        </section>
        <button class="btn">Ouvrir un courrier</button>
      </div>
    </main>

    <div class="modal" data-modal>
      <div class="container">
        <button data-close>&times;</button>
        <h3 class="title">Nouveau Courrier</h3>
        <form method="post">
          <fieldset>
            <legend>Type de courrier</legend>
            <label for="entrant"
              ><input
                type="radio"
                name="type"
                id="entrant"
                value="entrant"
              />Courrier Entrant</label
            >
            <label for="sortant"
              ><input
                type="radio"
                name="type"
                id="sortant"
                value="sortant"
              />Courrier Sortant</label
            >
          </fieldset>
          <fieldset>
            <legend>Info Courrier</legend>
            <div class="group">
              <label for="ref">Reference</label>
              <input type="text" autocomplete="off" name="ref" id="ref" />
            </div>
            <div class="group">
              <label for="objet">Objet</label>
              <input type="text" autocomplete="off" name="objet" id="objet" />
            </div>
            <div class="group">
              <label for="source">Source</label>
              <input type="text" autocomplete="off" name="source" id="source" />
            </div>
            <div class="group">
              <label for="desti">Destinataires</label>
              <input type="text" autocomplete="off" name="desti" id="desti" />
            </div>
            <div class="group">
              <label for="date">Date de depot</label>
              <input type="date" name="date" id="date" />
            </div>
            <div class="group">
              <label for="heure">Heure de depot</label>
              <input type="time" name="heure" id="heure" />
            </div>
            <section>
              <fieldset>
                <legend>Pièces jointes</legend>
                <span class="icons"> 
                  <a href="#" title="pièces jointes"><img src="<?= SITE_URL ?>/assets/img/icons/solid/p.svg" height="16"></a>
                </span>
                <table>
                  <thead>
                    <th>T</th>
                    <th>Pièces jointes</th>
                    <th>Taille</th>
                  </thead>
                  <tbody data-tbody>
                    <tr>
                      <td data-t>ii</td>
                      <td data-doc>info</td>
                      <td data-taille>2 Mo</td>
                    </tr>
                  </tbody>
                </table>
              </fieldset>
              <fieldset>
                <legend>Niveau d'importance</legend>
              </fieldset>
            </section>
          </fieldset>
        </form>
      </div>
    </div>