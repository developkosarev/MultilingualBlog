export default class BlogApiService {

    constructor()
    {
        this._apiBase = '';
    }

    param(obj)
    {
        let str = [];
        for (let p in obj) {
            if (obj[p]) {
                str.push(p + '=' + obj[p])
            }
        }
        return str.join('&')
    }

    makeUrl(url, filter)
    {
        const strFilter = this.param(filter);

        let resUrl = `${this._apiBase}${url}`;
        if (strFilter !== '') {
            resUrl += '?' + strFilter;
        }

        return resUrl
    }

    async getResource(url, filter = {})
    {
        const resUrl = this.makeUrl(url, filter);

        const res = await fetch(resUrl);
        if (!res.ok) {
            throw new Error(`Could not fetch ${url}, received ${res.status}`)
        }
        let data = await res.json();

        return data;
    }

    async postResource(url, data)
    {
        const resUrl = this.makeUrl(url);

        const res = await fetch(resUrl,{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        if (!res.ok) {
            throw new Error(`Could not post ${url}, received ${res.status}`)
        }
        let resdata = await res.json();

        return resdata;
    }

    async putResource(url, data)
    {
        const resUrl = this.makeUrl(url);

        const res = await fetch(resUrl,{
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        if (!res.ok) {
            throw new Error(`Could not put ${url}, received ${res.status}`)
        }
        let resdata = await res.json();

        return resdata;
    }

    async deleteResource(url)
    {
        const resUrl = this.makeUrl(url, {});

        const res = await fetch(resUrl,{
            method: 'DELETE'
        });

        if (!res.ok) {
            throw new Error(`Could not delete ${url}, received ${res.status}`)
        }

        return res;
    }

    /* ----------------------------------------------------------------------- */
    async getBlog(page = 1, pageLimit = 20)
    {
        const filter = {
            page: page,
            pagelimit: pageLimit
        };

        const res = await this.getResource('api/blog');

        return res;
    }

    async getPost(id)
    {
        const res = await this.getResource(`api/blog/id/${id}`);

        return res;
    }

    async getPostSlug(slug)
    {
        const res = await this.getResource(`api/blog/${slug}`);

        return res;
    }

    async addPost(post)
    {
        const res = await this.postResource(`api/blog/create`, post);

        return res;
    }

    async updatePost(post)
    {
        const res = await this.putResource(`api/blog/${post.id}`, post);

        return res;
    }

    async deletePost(id)
    {
        const res = await this.deleteResource(`api/blog/${id}`);

        return res;
    }
    /* ----------------------------------------------------------------------- */
    async getProduct(page = 1, pageSize = 25)
    {
        const filter = {
            page: page,
            pageSize: pageSize
        };

        const res = await this.getResource(`api/product/page/${page}/size/${pageSize}`, page, pageSize);

        return res;
    }

    /*
    getLocales(){
        return {
            currentLocale: 'en',
            locales: [{id: 'de', name: 'Deutsch'},
                      {id: 'en', name: 'English'}]
        }
    }
    */

}