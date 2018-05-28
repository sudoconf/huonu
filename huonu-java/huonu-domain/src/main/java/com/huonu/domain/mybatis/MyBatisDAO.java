
package com.huonu.domain.mybatis;

import java.util.HashMap;
import java.util.List;
import java.util.Map;

import org.apache.ibatis.session.RowBounds;
import org.apache.ibatis.session.SqlSession;
import org.mybatis.spring.support.SqlSessionDaoSupport;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import com.huonu.utils.mybaris.MapMapper;




public class MyBatisDAO extends SqlSessionDaoSupport {

    private static final Logger logger = LoggerFactory.getLogger("SQL_LOGGER");

    public MyBatisDAO() {

    }

    /**
     * 插入一个实体
     * 
     * @param sqlMapId mybatis 映射id
     * @param object 实体参数
     * @return
     */
    public int insert(final String sqlMapId, final Object object) {

        return (Integer) execute(new SqlSessionCallback() {

            public Object doInSession(SqlSession session) {
                try{
                    return session.insert(sqlMapId, object);
                }catch(Exception e){
                     logger.info("sql:{}",sqlMapId);
                     logger.error("fail to execute the sql",e);                     
                     throw new RuntimeException("Database access failed!", e);
                }
            }
        });
    }

    /**
     * 批量插入一个实体
     *
     * @param sqlMapId mybatis 映射id
     * @param object 实体参数
     * @return
     */
    public int batchInsert(final String sqlMapId, final List<?> object) {

        return (Integer) execute(new SqlSessionCallback() {

            public Object doInSession(SqlSession session) {
                try{
						for (Object o : object) {
							 session.insert(sqlMapId, o);
						}
                	return 0;
                }catch(Exception e){
                     logger.info("sql:{}",sqlMapId);
                     logger.error("fail to execute the sql",e);                     
                     throw new RuntimeException("Database access failed!", e);
                }
            }
        });
    }

    /**
     * 查询列表
     * 
     * @param sqlMapId
     *            mybatis映射id
     * @return
     */
    @SuppressWarnings("rawtypes")
    public List findForList(String sqlMapId) {
        return findForList(sqlMapId, null);
    }

    /**
     * 查询列表
     * 
     * @param sqlMapId
     *            mybatis映射id
     * @param param
     *            查询参数
     * @return
     */
    @SuppressWarnings("rawtypes")
    public List findForList(final String sqlMapId, final Object param) {

        return (List) execute(new SqlSessionCallback() {

            public Object doInSession(SqlSession session) {
                try{
                    if (param != null) {
                        return session.selectList(sqlMapId, param);
                    } else {
                        return session.selectList(sqlMapId);
                    }
                }catch(Exception e){
                     logger.info("sql:{}",sqlMapId);
                     logger.error("fail to execute the sql",e);                     
                     throw new RuntimeException("Database access failed!", e);
                }
            }
        });
    }

    /**
     * 查询列表
     * 
     * @param sqlMapId
     *            mybatis映射id
     * @param param
     *            查询参数
     * @param offset
     *            查询起始位置(偏移量),从1开始
     * @param limit
     *            查询数量,必须大于0
     * @return
     */
    @SuppressWarnings("rawtypes")
    public List findForList(final String sqlMapId, final Object param,
            final int offset, final int limit) {

        return (List) execute(new SqlSessionCallback() {

            public Object doInSession(SqlSession session) {
                try{
                    return session.selectList(sqlMapId, param, new RowBounds(offset, limit));
                }catch(Exception e){
                    logger.info("sql:{}",sqlMapId);
                    logger.error("fail to execute the sql",e);
                    throw new RuntimeException("Database access failed!", e);
                }
            }
        });
    }

    /**
     * 获取结果集的map
     * 
     * @param sqlMapId
     *            mybatis映射id
     * @param mapMapper
     *            处理多行结果集的接口,指定map的key和value
     * @return 结果对象的map
     */
    @SuppressWarnings("rawtypes")
    public Map findForMap(final String sqlMapId, final MapMapper mapMapper) {

        return findForMap(sqlMapId, null, mapMapper);
    }

    /**
     * 获取结果集的map
     * 
     * @param sqlMapId
     *            mybatis映射id
     *            参数数组
     * @param mapMapper
     *            处理多行结果集的接口,指定map的key和value
     * @return
     */
    @SuppressWarnings({ "rawtypes", "unchecked" })
    public Map findForMap(final String sqlMapId, final Object parameter,
            final MapMapper mapMapper) {

        List list = null;
        if (parameter == null) {
            list = findForList(sqlMapId);
        } else {
            list = findForList(sqlMapId, parameter);
        }

        Map result = new HashMap();
        for (int i = 0; i < list.size(); i++) {
            result.put(mapMapper.mapKey(list.get(i), i + 1), mapMapper.mapValue(list.get(i), i + 1));
        }
        return result;
    }


    /**
     * 查询得到一个实体
     * 
     * @param sqlMapId
     *            mybatis映射id
     * @return
     */
    public Object findForObject(final String sqlMapId) {

        return findForObject(sqlMapId, null);
    }

    /**
     * 查询得到一个实体
     * 
     * @param sqlMapId
     *            mybatis映射id
     * @param param
     *            查询参数
     * @return
     */
    public Object findForObject(final String sqlMapId, final Object param) {

        return execute(new SqlSessionCallback() {

            public Object doInSession(SqlSession session) {
                try{
                    if (param != null) {
                        return session.selectOne(sqlMapId, param);
                    } else {
                        return session.selectOne(sqlMapId);
                    }
                }catch(Exception e){
                    logger.info("sql:{}",sqlMapId);
                    logger.error("fail to execute the sql",e);
                    throw new RuntimeException("Database access failed!", e);
                }
            }
        });
    }

    /**
     * 修改
     * 
     * @param sqlMapId
     *            mybatis映射id
     * @param param
     *            参数
     * @return
     */
    public int update(final String sqlMapId, final Object param) {

        return (Integer) execute(new SqlSessionCallback() {

            public Object doInSession(SqlSession session) {
                try {
                    return session.update(sqlMapId, param);
                } catch (Exception e) {
                     logger.info("sql:{}",sqlMapId);
                     logger.error("fail to execute the sql",e);
                     throw new RuntimeException("Database access failed!", e);
                }                
            }
        });
    }

    /**
     * 修改
     * 
     * @param sqlMapId
     *            mybatis映射id
     * @param param
     *            参数
     * @return
     * @throws WSMessage
     */
    public int batchUpdate(final String sqlMapId, final List<?> param) {

        return (Integer) execute(new SqlSessionCallback() {

            public Object doInSession(SqlSession session) {
                try {
                	for (Object object : param) {
                		session.update(sqlMapId, object);
					}
                    return 0;
                } catch (Exception e) {
                     logger.info("sql:{}",sqlMapId);
                     logger.error("fail to execute the sql",e);
                     throw new RuntimeException("Database access failed!", e);
                }                
            }
        });
    }
    /**
     * 删除
     * 
     * @param sqlMapId
     *            mybatis映射id
     * @return
     */
    public int delete(final String sqlMapId) {

        return delete(sqlMapId, null);
    }

    /**
     * 带有参数删除
     * 
     * @param sqlMapId
     *            mybatis映射id
     * @param param
     *            参数
     * @return
     */
    public int delete(final String sqlMapId, final Object param) {

        return (Integer) execute(new SqlSessionCallback() {

            public Object doInSession(SqlSession session) {

                if (param != null) {
                    return session.delete(sqlMapId, param);
                } else {
                    return session.delete(sqlMapId);
                }
            }
        });
    }

    /**
     * 修改
     *
     * @param sqlMapId
     *            mybatis映射id
     * @param param
     *            参数
     * @return
     * @throws WSMessage
     */
    public int batchDelete(final String sqlMapId, final List<?> param) {

        return (Integer) execute(new SqlSessionCallback() {

            public Object doInSession(SqlSession session) {
                try {
                    for (Object object : param) {
                        session.delete(sqlMapId, object);
                    }
                    return 0;
                } catch (Exception e) {
                    logger.info("sql:{}",sqlMapId);
                    logger.error("fail to execute the sql",e);
                    throw new RuntimeException("Database access failed!", e);
                }
            }
        });
    }

    /**
     * 允许回调,暴露SqlSession给调用者
     * 
     * @param action
     * @return
     */
    public Object execute(SqlSessionCallback action) {

        try {
            return action.doInSession(getSqlSession());
        } catch (Exception e) {
             logger.error("fail to execute the sql",e);
             throw new RuntimeException("Database access failed!", e);
        }
    }

    public interface SqlSessionCallback {

        public Object doInSession(SqlSession session);
    }
}
