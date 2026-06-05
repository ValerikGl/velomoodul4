export default {
  mounted(el) {
    el.classList.add('reveal-hidden')

    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting) {
          el.classList.add('reveal-visible')
          observer.unobserve(el)
        }
      },
      {
        threshold: 0.15,
      },
    )

    observer.observe(el)
  },
}