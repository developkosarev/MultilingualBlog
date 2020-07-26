export default class FakeApiService {

  async getBlog(page = 1, pageLimit = 20) {
      const filter = {
          page: page,
          pagelimit: pageLimit
      };

      let res = await this.getResource('api/blog');

      //res = this._transformPagination(res);
      //res.data = res.data.map(this._transformPost);

      return res;
  }

  async getBlogFake(){
    return {
      1: {
          id: 1,
          title: 'Blog 1'
      },
      2: {
          id: 2,
          title: 'Blog2'
      }
    }
  }

  async getLang(){
    return {
      currentLocale:'en',
      data: [{id: 'de', name: 'Deutsch'},{id: 'en', name: 'English'}]
    }
  }

  async getPost(id){
    //let res = await this.getResource(`blog/post/${id}`);

    res = this._transformPost(res);

    return res;
  }


  _transformPost(post) {
    return {
      id: post.id,
      title: post.title
    }
  }

  _transformPagination(pagination) {
    return {
      currentPageNumber: pagination.current_page
      //totalItems: pagination.total,
      //totalPages: pagination.last_page,
      //itemsPerPage: pagination.per_page,
      //data: pagination.data
    }
  }
}