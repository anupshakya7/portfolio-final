document.querySelectorAll('.has-dropdown').forEach(item => {
    const dropdown = item.querySelector('.dropdown-menu');

    item.addEventListener('mouseenter',()=>{
        dropdown.classList.remove('up');

        requestAnimationFrame(() => {
            const rect = dropdown.getBoundingClientRect();
            const dropdownHeight = rect.height;
            const spaceBelow = window.innerHeight - rect.top - dropdownHeight;
            const spaceAbove = rect.top;
            
            if(spaceBelow < 20 && spaceAbove > dropdownHeight){
                dropdown.classList.add('up');
            }
        });
    });
    
    item.addEventListener('mouseleave',()=>{
        dropdown.classList.remove('up');
    });
});