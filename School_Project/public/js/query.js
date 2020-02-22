var tabs = document.querySelectorAll('.maskor .navor a')
var menuActivator = document.querySelector('.maskor .menu-activator')
var menuSelf = document.querySelector('.maskor .navor .menu')
var addNow = document.getElementById('addNow')


for (var i = 0; i < tabs.length; i++) {
	tabs[i].addEventListener('click', function(e){

		var maskor = this.parentNode.parentNode

		if(!this.classList.contains('active')){
			var olderActive = document.querySelector('.maskor .navor a.active')
			olderActive.classList.remove('active')
			this.classList.add('active')
			this.classList.remove('hover')
			olderActive.classList.add('hover')
			
		}
	})
}


var hash = window.location.hash 
console.log(hash)



