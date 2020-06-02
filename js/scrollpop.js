const docBody = document.body;

class ScrollPop {

  constructor(fold = 64) {
    this.foldHeight = fold;
    this.poppable = [];
    this.updatePoppable();
    window.addEventListener('scroll', ev => this.doPop(ev));
  }

  doPop() {

    requestAnimationFrame( () => {
      this.docScrolls = {
        top : document.body.scrollTop + document.documentElement.scrollTop,
        bottom : document.body.scrollTop + document.documentElement.scrollTop + document.documentElement.clientHeight,
      };
      //check for above the fold
      if ( this.docScrolls.top > this.constructor.foldHeight) { docBody.classList.add('past-fold') } else { docBody.classList.remove('past-fold') }

      //do not scrollPop if page is transitioning
      if ( docBody.classList.contains("transition") ) { return false; }

      //go through all poppable elements
      this.poppable.forEach(popper => {
        const elRect = popper.getBoundingClientRect();
        const elCoords = {
            top: elRect.top + this.docScrolls.top,
            bottom: elRect.height + elRect.top + this.docScrolls.top
        };

        if ((elCoords.top <= this.docScrolls.bottom) && (elCoords.bottom >= this.docScrolls.top)) {
          popper.classList.add("pop");
        } else {
          if (!popper.classList.contains('poponce')) popper.classList.remove("pop");
        }

      })

      return true;

    })
  }

  updatePoppable() {
    this.poppable = docBody.querySelectorAll('.scrollpop, .lazyload');
  }

}

loaded = setTimeout(function(){
  finishedLoading();
}, 3000);

imagesLoaded( document.querySelector('main'), function( instance ) {
  clearTimeout(loaded);
  loaded = setTimeout(function(){
    finishedLoading();
  }, 250);
});

const finishedLoading = loader => {
  document.body.classList.remove('loading');
  document.querySelectorAll(".readypop").forEach(pop => { pop.classList.add('pop') });
  scrollPop = new ScrollPop();
  document.getElementById('modal').addEventListener('scroll', e => {
    scrollPop.doPop();
  });
  setupContent();
}
