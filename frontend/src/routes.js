module.exports = [
    {
        path: '/',
        component: () => import('@/pages/home/Home')
    },
    {
        path: '/Profile',
        component: () => import('@/pages/profile/Profile')
    },
    {
        path: '/Imprint',
        component: () => import('@/pages/imprint/Imprint')
    },
];