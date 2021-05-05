module.exports = [
    {
        path: '/',
        component: () => import('@/pages/home/Home')
    },
    {
        path: '/profile',
        component: () => import('@/pages/profile/Profile')
    },
    {
        path: '/imprint',  name: 'Imprint',
        component: () => import('@/pages/imprint/Imprint')
    },
    {
        path: '/privacy', name: 'Data',
        component: () => import('@/pages/dataprivacy/Dataprivacy')
    },
];