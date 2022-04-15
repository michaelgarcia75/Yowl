export default function auth ({ next, router }) {
  if (!localStorage.getItem('vuex')) {
    return router.push({ name: 'login' })
  }

  return next()
}
