module.exports = [
    {
        path: '/',
        component: () => import('@/pages/home/Home')
    },
    {
        path: '/profil',
        component: () => import('@/pages/profil/Profil')
    },
];