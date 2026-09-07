document.addEventListener('DOMContentLoaded', () => {
	const tabs = document.querySelectorAll('.cluster-tab');
	const cards = document.querySelectorAll('.article-card');

	tabs.forEach((tab) => {
		tab.addEventListener('click', () => {
			tabs.forEach((item) => item.classList.remove('is-active'));
			tab.classList.add('is-active');

			const filter = tab.dataset.filter;
			cards.forEach((card) => {
				card.hidden = filter !== 'all' && card.dataset.cluster !== filter;
			});
		});
	});
});
