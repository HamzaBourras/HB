
  function CreditC(){

    let MNTPR = document.getElementById('ID1').value;
    let TAUXANN = document.getElementById('ID2').value;
    let DUREE = document.getElementById('ID3').value;

    let PaimMens = (MNTPR * (TAUXANN/12)) /(1-(1+TAUXANN/12)**(-DUREE));

    let VAE = document.getElementById('ID');

    let NEWS = document.createElement('span');
    
    NEWS.textContent = PaimMens ;

    VAE.append(NEWS);

  }
