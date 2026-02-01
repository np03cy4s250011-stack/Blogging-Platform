document.addEventListener('DOMContentLoaded', () => {
  const btn = document.getElementById('load-more');
  const list = document.getElementById('post-list');
  if (!btn || !list) return;

  btn.addEventListener('click', async () => {
    const offset = parseInt(btn.dataset.offset || '0', 10);
    const res = await fetch(`/public/load_more.php?offset=${offset}`);
    const html = await res.text();
    if (html.trim() === '') {
      btn.disabled = true;
      btn.textContent = 'No more posts';
      return;
    }
    list.insertAdjacentHTML('beforeend', html);
    btn.dataset.offset = offset + 5;
  });
});
